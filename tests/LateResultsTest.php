<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\Psr7\Response;
use NoResponse\LateResults\AccountStateAnswer;
use NoResponse\LateResults\LateResults;
use NoResponse\LateResults\ProviderActionException;
use NoResponse\Models\Shared\Account;
use NoResponse\NoResponseClient;
use NoResponse\Utils\JSON;
use NoResponse\WebhookVerification\WebhookVerificationException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * The shared late enforcement vectors through LateResults::handleRiskChange, plus what the vectors cannot say in
 * JSON: verification, the custom provider and missing credentials.
 */
final class LateResultsTest extends TestCase
{
    /** @return array<string, mixed> */
    private static function vectors(): array
    {
        return json_decode(self::vectorsText(), true, 512, JSON_THROW_ON_ERROR);
    }

    private static function vectorsText(): string
    {
        return (string) file_get_contents(__DIR__.'/fixtures/late-results-vectors.json');
    }

    /** The vectors as objects, so an empty JSON object re-encodes as {}. */
    private static function vectorObjects(): object
    {
        return json_decode(self::vectorsText(), false, 512, JSON_THROW_ON_ERROR);
    }

    /** @return array{string, array<string, string>} */
    private static function sign(object $event): array
    {
        $v = self::vectors();
        $raw = json_encode($event, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
        $stamp = (string) $v['now'];
        $headers = [
            'NR-Webhook-Id' => $event->id,
            'NR-Webhook-Timestamp' => $stamp,
            'NR-Webhook-Key-Id' => $v['key_id'],
            'NR-Webhook-Signature' => 'v1='.hash_hmac('sha256', "{$stamp}.{$raw}", $v['secret_utf8']),
        ];

        return [$raw, $headers];
    }

    /** Method, path and query as an order-free set of decoded pairs. */
    private static function normalize(string $method, string $url): string
    {
        $parts = parse_url($url);
        $pairs = [];
        foreach (explode('&', $parts['query'] ?? '') as $pair) {
            if ($pair === '') {
                continue;
            }
            [$key, $value] = array_pad(explode('=', $pair, 2), 2, '');
            $pairs[] = urldecode($key).'='.urldecode($value);
        }
        sort($pairs);

        return "{$method} {$parts['scheme']}://{$parts['host']}{$parts['path']}?".implode('&', $pairs);
    }

    /**
     * A Guzzle client that serves the exchanges in order and fails on anything else, and a check that all were used.
     *
     * @param  list<object>  $exchanges
     * @return array{Client, \Closure(): void}
     */
    private function transcript(array $exchanges): array
    {
        $next = 0;
        $handler = function (RequestInterface $request) use (&$next, $exchanges) {
            $got = self::normalize($request->getMethod(), (string) $request->getUri());
            $this->assertArrayHasKey($next, $exchanges, "unexpected request {$got}");
            $expected = $exchanges[$next];
            $this->assertSame(self::normalize($expected->request->method, $expected->request->url), $got, "request {$next}");
            if (property_exists($expected->request, 'body')) {
                $this->assertEquals(
                    json_decode(json_encode($expected->request->body, JSON_THROW_ON_ERROR), true),
                    json_decode((string) $request->getBody(), true),
                    "body of request {$next}",
                );
            }
            $next++;
            $response = $expected->response;
            $hasBody = property_exists($response, 'body') && $response->status !== 204;
            $body = $hasBody ? json_encode($response->body, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES) : '';

            return Create::promiseFor(new Response($response->status, (array) ($response->headers ?? []), $body));
        };
        $client = new Client(['handler' => HandlerStack::create($handler), 'http_errors' => false]);

        return [$client, function () use (&$next, $exchanges): void {
            $this->assertSame(count($exchanges), $next, 'every exchange was requested');
        }];
    }

    private static function client(Client $http): NoResponseClient
    {
        $v = self::vectors();

        return NoResponseClient::builder()->setClient($http)->setSecurity($v['api_key'])->setServerUrl($v['api_base_url'])->build();
    }

    /** @return array<string, array{int}> */
    public static function cases(): array
    {
        $cases = [];
        foreach (self::vectors()['cases'] as $index => $case) {
            $cases[$case['name']] = [$index];
        }

        return $cases;
    }

    #[DataProvider('cases')]
    public function test_vector(int $index): void
    {
        $v = self::vectors();
        $vector = $v['cases'][$index];
        $objects = self::vectorObjects()->cases[$index];
        [$http, $done] = $this->transcript($objects->exchanges);
        $provider = LateResults::identityProvider($vector['provider'], $v['provider_token'], domain: $vector['domain'] ?? null, http: $http);
        [$raw, $headers] = self::sign($objects->event);
        $getAccountState = function (Account $account) use ($vector): ?AccountStateAnswer {
            $this->assertSame($vector['event']['data']['account']['id'], $account->id);
            $state = $vector['state'];

            return $state === null ? null : new AccountStateAnswer($state['state'], $state['user_id'] ?? null, $state['enforced_risk_version'] ?? null);
        };
        $run = fn () => LateResults::handleRiskChange(
            self::client($http), $raw, $headers, [$v['key_id'] => $v['secret_utf8']], $provider, $getAccountState,
            $vector['flows'] ?? [], now: $v['now'],
        );
        if ($vector['error'] !== null) {
            try {
                $run();
                $this->fail('expected ProviderActionException');
            } catch (ProviderActionException $error) {
                $done();
                $this->assertSame($vector['error'], ['provider' => $error->provider, 'status' => $error->status, 'code' => $error->errorCode]);
            }

            return;
        }
        $result = $run();
        $done();
        $this->assertSame($vector['result']['skipped'], $result->skipped);
        $enforcements = array_map(
            fn ($e) => ['flow' => $e->flow, 'action' => $e->action, 'status' => $e->status] + ($e->errorCode !== null ? ['error_code' => $e->errorCode] : []),
            $result->enforcements,
        );
        $this->assertSame($vector['result']['enforcements'], $enforcements);
    }

    public function test_a_delivery_that_fails_verification_reads_and_acts_on_nothing(): void
    {
        $v = self::vectors();
        [$http, $done] = $this->transcript([]);
        [$raw, $headers] = self::sign(self::vectorObjects()->cases[0]->event);
        $this->expectException(WebhookVerificationException::class);
        try {
            LateResults::handleRiskChange(
                self::client($http), $raw.' ', $headers, [$v['key_id'] => $v['secret_utf8']], LateResults::customProvider([]),
                fn () => $this->fail('not called'), now: $v['now'],
            );
        } finally {
            $done();
        }
    }

    public function test_a_custom_provider_runs_your_functions_and_a_missing_one_fails_the_action(): void
    {
        $v = self::vectors();
        $account = JSON::createSerializer()->deserialize(
            json_encode($v['cases'][0]['exchanges'][0]['response']['body'], JSON_THROW_ON_ERROR),
            Account::class,
            'json',
        );
        $recorded = [];
        $handler = function (RequestInterface $request) use (&$recorded) {
            $body = json_decode((string) $request->getBody(), true);
            $recorded[] = [$body['action'], $body['status'], $body['error_code'] ?? null, $body['provider']];
            $stored = $body + ['id' => 'enf_01JA2ZF5N6P7Q8R9S0T1V2W3X4', 'account_id' => 'acct_7f3a9c', 'created_at' => '2026-10-23T09:00:06.000Z'];

            return Create::promiseFor(new Response(201, ['content-type' => 'application/json'], json_encode($stored, JSON_THROW_ON_ERROR)));
        };
        $client = self::client(new Client(['handler' => HandlerStack::create($handler), 'http_errors' => false]));
        $ran = [];
        $provider = LateResults::customProvider(['restrict' => function (string $userId) use (&$ran) {
            $ran[] = ['restrict', $userId];

            return true; // a return value that is not a list of actions
        }]);
        try {
            LateResults::enforceAccount($client, $account, $provider, fn () => new AccountStateAnswer('active', 'u_1'));
            $this->fail('expected the missing revoke_sessions handler to fail');
        } catch (\InvalidArgumentException) {
        }
        $this->assertSame([['restrict', 'u_1']], $ran);
        $this->assertSame([
            ['restrict', 'applied', null, 'custom'],
            ['revoke_sessions', 'failed', 'custom.error', 'custom'],
        ], $recorded);
    }

    /** @return array<string, array{string, ?string}> */
    public static function missingCredentials(): array
    {
        return ['clerk without token' => ['clerk', ''], 'auth0 without domain' => ['auth0', 't'], 'unknown provider' => ['okta', 't']];
    }

    #[DataProvider('missingCredentials')]
    public function test_identity_provider_needs_its_credentials(string $name, string $token): void
    {
        $this->expectException(\InvalidArgumentException::class);
        LateResults::identityProvider($name, $token);
    }
}
