<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use NoResponse\Assessments;
use NoResponse\NoResponseClient;
use NoResponse\NoResponseClientBuilder;
use NoResponse\Utils;
use NoResponse\WebhookEndpoints;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

final class TransportTest extends TestCase
{
    private const ASSESSMENT_ID = 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM';

    private const ENV = 'NORESPONSE_API_KEY';

    private string|false $savedKey = false;

    protected function setUp(): void
    {
        $this->savedKey = getenv(self::ENV);
    }

    protected function tearDown(): void
    {
        putenv($this->savedKey === false ? self::ENV : self::ENV.'='.$this->savedKey);
    }

    /**
     * @param  array<mixed>  $history
     */
    private static function recording(array &$history): NoResponseClientBuilder
    {
        $body = (string) file_get_contents(__DIR__.'/fixtures/valid/assessment-view-complete.json');
        $stack = HandlerStack::create(fn () => \GuzzleHttp\Promise\Create::promiseFor(
            new Response(200, ['Content-Type' => 'application/json'], $body),
        ));
        $stack->push(Middleware::history($history));

        return NoResponseClient::builder()
            ->setClient(new Client(['handler' => $stack, 'http_errors' => false]))
            ->setServerUrl('https://api.example.test');
    }

    private static function unreachable(): NoResponseClientBuilder
    {
        $stack = HandlerStack::create(function (RequestInterface $request) {
            throw new ConnectException('Connection refused', $request);
        });

        return NoResponseClient::builder()
            ->setClient(new Client(['handler' => $stack, 'http_errors' => false]))
            ->setSecurity('nrk_test_'.str_repeat('k', 20))
            ->setServerUrl('https://api.example.test');
    }

    public function test_the_key_falls_back_to_the_environment(): void
    {
        putenv(self::ENV.'=nrk_env_'.str_repeat('e', 20));
        $history = [];
        self::recording($history)->build()->assessments->get(self::ASSESSMENT_ID);
        $this->assertSame('Bearer nrk_env_'.str_repeat('e', 20), $history[0]['request']->getHeaderLine('Authorization'));
    }

    public function test_a_key_passed_in_code_wins_over_the_environment(): void
    {
        putenv(self::ENV.'=nrk_env_'.str_repeat('e', 20));
        $history = [];
        self::recording($history)->setSecurity('nrk_code_'.str_repeat('c', 20))->build()->assessments->get(self::ASSESSMENT_ID);
        $this->assertSame('Bearer nrk_code_'.str_repeat('c', 20), $history[0]['request']->getHeaderLine('Authorization'));
    }

    public function test_no_key_anywhere_sends_no_authorization_header(): void
    {
        putenv(self::ENV);
        $history = [];
        self::recording($history)->build()->assessments->get(self::ASSESSMENT_ID);
        $this->assertFalse($history[0]['request']->hasHeader('Authorization'));
    }

    public function test_a_connection_failure_with_retries_off_throws_a_guzzle_exception(): void
    {
        $client = self::unreachable()->setRetryConfig(new Utils\Retry\RetryConfigNone())->build();
        $this->expectException(ConnectException::class);
        $client->assessments->get(self::ASSESSMENT_ID);
    }

    public function test_a_connection_failure_with_retries_off_for_one_call_throws_a_guzzle_exception(): void
    {
        $options = Utils\Options::builder()->setRetryConfig(new Utils\Retry\RetryConfigNone())->build();
        $this->expectException(ConnectException::class);
        self::unreachable()->build()->assessments->get(self::ASSESSMENT_ID, null, $options);
    }

    public function test_a_connection_failure_after_the_retries_throws_a_guzzle_exception(): void
    {
        $options = Utils\Options::builder()
            ->setRetryConfig(new Utils\Retry\RetryConfigBackoff(1, 5, 1.1, 1, true))
            ->build();
        $this->expectException(ConnectException::class);
        self::unreachable()->build()->assessments->get(self::ASSESSMENT_ID, null, $options);
    }

    public function test_a_closed_port_with_retries_off_throws_a_guzzle_exception(): void
    {
        $client = NoResponseClient::builder()
            ->setSecurity('nrk_test_'.str_repeat('k', 20))
            ->setServerUrl('http://127.0.0.1:1')
            ->setRetryConfig(new Utils\Retry\RetryConfigNone())
            ->build();
        try {
            $client->assessments->get(self::ASSESSMENT_ID);
            $this->fail('expected a connection failure');
        } catch (GuzzleException $e) {
            $this->assertInstanceOf(ConnectException::class, $e);
        }
    }

    public function test_method_docblocks_name_every_exception_the_method_throws(): void
    {
        $expected = [
            [Assessments::class, 'create', ['BadRequestException', 'AuthenticationException', 'PermissionDeniedException', 'ConflictException', 'RateLimitException']],
            [Assessments::class, 'get', ['AuthenticationException', 'NotFoundException', 'RateLimitException']],
            [WebhookEndpoints::class, 'sendTestEvent', ['AuthenticationException', 'NotFoundException']],
        ];
        foreach ($expected as [$class, $method, $exceptions]) {
            $doc = (string) (new \ReflectionMethod($class, $method))->getDocComment();
            foreach ([...$exceptions, 'APIStatusException'] as $exception) {
                $this->assertStringContainsString('@throws \\NoResponse\\Models\\Errors\\'.$exception."\n", $doc, "{$class}::{$method}");
            }
            $this->assertStringContainsString('@throws \\GuzzleHttp\\Exception\\GuzzleException', $doc, "{$class}::{$method}");
        }
    }
}
