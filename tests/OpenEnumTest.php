<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use NoResponse\Models\Errors\NotFoundException;
use NoResponse\Models\Shared\AccountDecision;
use NoResponse\Models\Shared\IncompleteReason;
use NoResponse\Models\Shared\Lane;
use NoResponse\Models\Shared\ReasonCode;
use NoResponse\Models\Shared\Status;
use NoResponse\NoResponseClient;
use PHPUnit\Framework\TestCase;

/**
 * The API may add a value to any response enum without a new major version,
 * and the contract tells clients to ignore values they do not know. A known
 * value reads as its enum case; an unknown one reads as the raw string.
 */
final class OpenEnumTest extends TestCase
{
    private const ASSESSMENT_ID = 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM';

    private const UNKNOWN = 'a_value_from_a_later_api';

    private static function client(Response $response): NoResponseClient
    {
        return NoResponseClient::builder()
            ->setClient(new Client(['handler' => HandlerStack::create(new MockHandler([$response])), 'http_errors' => false]))
            ->setSecurity('nrk_test_'.str_repeat('k', 20))
            ->setServerUrl('https://api.example.test')
            ->build();
    }

    public function test_an_assessment_with_unknown_values_reads_them_as_strings(): void
    {
        $view = json_decode((string) file_get_contents(__DIR__.'/fixtures/valid/assessment-view-complete.json'), true, flags: JSON_THROW_ON_ERROR);
        $view['account']['risk']['reasons'][0]['code'] = self::UNKNOWN;
        $view['account']['risk']['decision'] = self::UNKNOWN;
        $view['account']['decisions_by_flow']['login'] = self::UNKNOWN;
        $view['detail']['incomplete_sources'] = [
            ['lane' => self::UNKNOWN, 'reason' => self::UNKNOWN],
            ['lane' => 'phone', 'reason' => 'timed_out'],
        ];
        $body = json_encode($view, JSON_THROW_ON_ERROR);

        $assessment = self::client(new Response(200, ['Content-Type' => 'application/json'], $body))
            ->assessments->get(self::ASSESSMENT_ID)->result;

        $this->assertNotNull($assessment);
        $this->assertSame(Status::Complete, $assessment->status);
        $account = $assessment->account;
        $this->assertNotNull($account);
        $this->assertSame(self::UNKNOWN, $account->risk->reasons[0]->code);
        $this->assertSame(ReasonCode::AgedIdentity, $account->risk->reasons[1]->code);
        $this->assertSame(self::UNKNOWN, $account->risk->decision);
        $this->assertSame(self::UNKNOWN, $account->decisionsByFlow->login);
        $this->assertSame(AccountDecision::Allow, $account->decisionsByFlow->purchase);
        [$unknown, $known] = $assessment->detail->incompleteSources;
        $this->assertSame(self::UNKNOWN, $unknown->lane);
        $this->assertSame(self::UNKNOWN, $unknown->reason);
        $this->assertSame(Lane::Phone, $known->lane);
        $this->assertSame(IncompleteReason::TimedOut, $known->reason);
    }

    public function test_an_error_with_an_unknown_code_still_raises_its_typed_exception(): void
    {
        $problem = json_encode([
            'type' => 'https://docs.noresponse.org/errors/not_found',
            'title' => 'Not found',
            'status' => 404,
            'detail' => 'No such assessment.',
            'code' => self::UNKNOWN,
            'request_id' => str_repeat('a', 32),
        ], JSON_THROW_ON_ERROR);

        try {
            self::client(new Response(404, ['Content-Type' => 'application/problem+json'], $problem))
                ->assessments->get(self::ASSESSMENT_ID);
            $this->fail('expected an exception');
        } catch (NotFoundException $e) {
            $this->assertSame(self::UNKNOWN, $e->container->code);
        }
    }
}
