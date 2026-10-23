<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use NoResponse\Models\Errors\NoResponseException;
use NoResponse\Models\Errors\NotFoundException;
use NoResponse\Models\Shared\AssessmentRequest;
use NoResponse\Models\Shared\AssessmentRequestIdentifiers;
use NoResponse\Models\Shared\Flow;
use NoResponse\NoResponseClient;
use NoResponse\Utils;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    private const UUID = '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/';

    private static function body(string $name): string
    {
        return (string) file_get_contents(__DIR__.'/fixtures/valid/'.$name);
    }

    /**
     * @param  list<Response>  $responses
     * @param  array<mixed>  $history
     */
    private static function client(array $responses, array &$history): NoResponseClient
    {
        $stack = HandlerStack::create(new MockHandler($responses));
        $stack->push(Middleware::history($history));

        return NoResponseClient::builder()
            ->setClient(new Client(['handler' => $stack, 'http_errors' => false]))
            ->setSecurity('nrk_test_'.str_repeat('k', 20))
            ->setServerUrl('https://api.example.test')
            ->build();
    }

    private static function request(): AssessmentRequest
    {
        return new AssessmentRequest(
            accountId: 'acct_7f3a9c',
            flow: Flow::Signup,
            identifiers: new AssessmentRequestIdentifiers(email: 'new.user@example.com'),
        );
    }

    public function test_create_sends_a_generated_idempotency_key(): void
    {
        $json = ['Content-Type' => 'application/json'];
        $history = [];
        $client = self::client([
            new Response(200, $json, self::body('assessment-view-complete.json')),
            new Response(200, $json, self::body('assessment-view-complete.json')),
        ], $history);
        $client->assessments->create(self::request());
        $client->assessments->create(self::request());
        $first = $history[0]['request']->getHeaderLine('Idempotency-Key');
        $second = $history[1]['request']->getHeaderLine('Idempotency-Key');
        $this->assertMatchesRegularExpression(self::UUID, $first);
        $this->assertMatchesRegularExpression(self::UUID, $second);
        $this->assertNotSame($first, $second);
    }

    public function test_create_keeps_the_callers_idempotency_key(): void
    {
        $history = [];
        $client = self::client([
            new Response(200, ['Content-Type' => 'application/json'], self::body('assessment-view-complete.json')),
        ], $history);
        $client->assessments->create(self::request(), 'signup-usr_8f2k1-0001');
        $this->assertSame('signup-usr_8f2k1-0001', $history[0]['request']->getHeaderLine('Idempotency-Key'));
    }

    public function test_a_retry_sends_the_same_idempotency_key_and_honours_the_call_options(): void
    {
        $json = ['Content-Type' => 'application/json'];
        $history = [];
        $client = self::client([
            new Response(503, ['Content-Type' => 'application/problem+json'], '{}'),
            new Response(200, $json, self::body('assessment-view-complete.json')),
        ], $history);
        $options = Utils\Options::builder()
            ->setRetryConfig(new Utils\Retry\RetryConfigBackoff(1, 5, 1.1, 1000, false))
            ->build();
        $client->assessments->create(self::request(), null, $options);
        $this->assertCount(2, $history);
        $this->assertMatchesRegularExpression(self::UUID, $history[0]['request']->getHeaderLine('Idempotency-Key'));
        $this->assertSame(
            $history[0]['request']->getHeaderLine('Idempotency-Key'),
            $history[1]['request']->getHeaderLine('Idempotency-Key'),
        );
    }

    public function test_create_factory_builds_a_client(): void
    {
        $this->assertInstanceOf(NoResponseClient::class, NoResponseClient::create('nrk_test_'.str_repeat('k', 20)));
    }

    public function test_every_api_error_extends_the_base_exception(): void
    {
        $problem = json_encode([
            'type' => 'https://docs.noresponse.org/errors/not_found',
            'title' => 'Not found',
            'status' => 404,
            'detail' => 'No such assessment.',
            'code' => 'not_found',
            'request_id' => str_repeat('a', 32),
        ], JSON_THROW_ON_ERROR);
        $history = [];
        $client = self::client([new Response(404, ['Content-Type' => 'application/problem+json'], $problem)], $history);
        try {
            $client->assessments->get('asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM');
            $this->fail('expected an exception');
        } catch (NoResponseException $e) {
            $this->assertInstanceOf(NotFoundException::class, $e);
            $this->assertSame(404, $e->getStatusCode());
            $this->assertSame(str_repeat('a', 32), $e->getRequestId());
        }
    }
}
