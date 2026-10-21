<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use NoResponse\Models\Shared\Status;
use NoResponse\NoResponse;
use NoResponse\Wait;
use NoResponse\WaitTimeoutException;
use PHPUnit\Framework\TestCase;

final class WaitTest extends TestCase
{
    private static function body(string $name): string
    {
        return (string) file_get_contents(__DIR__.'/fixtures/valid/'.$name);
    }

    /**
     * @param  list<Response>  $responses
     * @param  array<mixed>  $history
     */
    private static function client(array $responses, array &$history): NoResponse
    {
        $stack = HandlerStack::create(new MockHandler($responses));
        $stack->push(Middleware::history($history));

        return NoResponse::builder()
            ->setClient(new Client(['handler' => $stack]))
            ->setSecurity('nrk_test_'.str_repeat('k', 20))
            ->setServerUrl('https://api.example.test')
            ->build();
    }


    public function test_polls_until_complete_honouring_retry_after(): void
    {
        $json = ['Content-Type' => 'application/json'];
        $history = [];
        $client = self::client([
            new Response(200, $json + ['Retry-After' => '3'], self::body('assessment-pending.json')),
            new Response(200, $json + ['Retry-After' => '0'], self::body('assessment-pending.json')),
            new Response(200, $json, self::body('assessment-complete.json')),
        ], $history);
        $slept = [];
        $now = 0.0;
        $result = Wait::wait($client, 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
            sleep: function (float $s) use (&$slept, &$now): void {
                $slept[] = $s;
                $now += $s;
            },
            clock: function () use (&$now): float {
                return $now;
            });
        $this->assertSame(Status::Complete, $result->status);
        $this->assertSame([3.0, 1.0], $slept);
        $this->assertCount(3, $history);
        $this->assertSame('/v1/assessments/asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM', $history[0]['request']->getUri()->getPath());
        $this->assertSame('Bearer nrk_test_'.str_repeat('k', 20), $history[0]['request']->getHeaderLine('Authorization'));
    }

    public function test_times_out_with_the_last_pending_assessment(): void
    {
        $json = ['Content-Type' => 'application/json', 'Retry-After' => '2'];
        $history = [];
        $pending = self::body('assessment-pending.json');
        $client = self::client([new Response(200, $json, $pending), new Response(200, $json, $pending), new Response(200, $json, $pending)], $history);
        $slept = [];
        $now = 0.0;
        try {
            Wait::wait($client, 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM', 5.0,
                function (float $s) use (&$slept, &$now): void {
                    $slept[] = $s;
                    $now += $s;
                },
                function () use (&$now): float {
                    return $now;
                });
            $this->fail('expected a timeout');
        } catch (WaitTimeoutException $e) {
            $this->assertSame(Status::Pending, $e->last->status);
        }
        $this->assertSame([2.0, 2.0], $slept);
    }
}
