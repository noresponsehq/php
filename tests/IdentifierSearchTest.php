<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use NoResponse\Models\Shared;
use NoResponse\NoResponseClient;
use PHPUnit\Framework\TestCase;

final class IdentifierSearchTest extends TestCase
{
    public function test_both_searches_keep_original_match_evidence(): void
    {
        $examples = json_decode((string) file_get_contents(__DIR__.'/fixtures/investigation-responses.json'), true, flags: JSON_THROW_ON_ERROR);
        $revision = $examples['revision'];
        $match = ['kind' => 'username', 'value' => 'JaneDoe', 'match_basis' => 'canonical', 'namespace' => 'customer', 'provenance' => 'submitted', 'assessment_id' => $revision['id']];
        $history = [];
        $stack = HandlerStack::create(function ($request) use ($revision, $match) {
            $item = $request->getUri()->getPath() === '/v1/accounts/search'
                ? ['account_id' => 'acct_7f3a9c', 'latest' => $revision, 'assessments' => 2, 'matched_identifier' => $match]
                : [...$revision, 'matched_identifier' => $match];
            $page = ['schema_version' => '1', 'items' => [$item], 'total' => 1, 'total_capped' => false];
            if ($request->getUri()->getPath() === '/v1/assessments/search') {
                $page['retention_days'] = 365;
            }
            return \GuzzleHttp\Promise\Create::promiseFor(new Response(200, ['Content-Type' => 'application/json'], json_encode($page, JSON_THROW_ON_ERROR)));
        });
        $stack->push(Middleware::history($history));
        $client = NoResponseClient::builder()->setClient(new Client(['handler' => $stack, 'http_errors' => false]))
            ->setSecurity('nrk_test_identifier_fixture')->setServerUrl('https://api.example.test')->build();
        $identifier = new Shared\IdentifierSearch(kind: 'username', value: 'janedoe', match: 'canonical', namespace: 'customer');
        $accounts = $client->accounts->search(new Shared\AccountDirectorySearchRequest(identifier: $identifier))->result;
        $assessments = $client->assessments->search(new Shared\AssessmentSearchRequest(from: '2026-10-01T00:00:00Z', to: '2026-10-02T00:00:00Z', identifier: $identifier))->result;
        foreach ([$accounts->items[0]->matchedIdentifier, $assessments->items[0]->matchedIdentifier] as $found) {
            self::assertInstanceOf(Shared\IdentifierMatch::class, $found);
            self::assertSame('JaneDoe', $found->value);
            self::assertSame($revision['id'], $found->assessmentId);
        }
        self::assertNull($accounts->items[0]->current);
        self::assertCount(2, $history);
        foreach ($history as $call) {
            self::assertSame('Bearer nrk_test_identifier_fixture', $call['request']->getHeaderLine('Authorization'));
            $sent = json_decode((string) $call['request']->getBody(), true, flags: JSON_THROW_ON_ERROR);
            self::assertEquals(['kind' => 'username', 'value' => 'janedoe', 'match' => 'canonical', 'namespace' => 'customer'], $sent['identifier']);
        }
    }
    public function test_both_searches_keep_nested_expressions_and_indexed_witnesses(): void
    {
        $examples = json_decode((string) file_get_contents(__DIR__.'/fixtures/investigation-responses.json'), true, flags: JSON_THROW_ON_ERROR);
        $revision = $examples['revision'];
        $match = ['kind' => 'username', 'value' => 'JaneDoe', 'match_basis' => 'canonical', 'namespace' => 'customer', 'provenance' => 'submitted', 'assessment_id' => $revision['id']];
        $match = [['kind' => 'phone', 'value' => '+14155552671', 'match_basis' => 'canonical', 'provenance' => 'submitted', 'assessment_id' => $revision['id'], 'term_index' => 0], [...$match, 'term_index' => 2]];
        $history = [];
        $stack = HandlerStack::create(function ($request) use ($revision, $match) {
            $item = $request->getUri()->getPath() === '/v1/accounts/search'
                ? ['account_id' => 'acct_7f3a9c', 'latest' => $revision, 'assessments' => 2, 'matched_identifiers' => $match]
                : [...$revision, 'matched_identifiers' => $match];
            $page = ['schema_version' => '1', 'items' => [$item], 'total' => 1, 'total_capped' => false];
            if ($request->getUri()->getPath() === '/v1/assessments/search') {
                $page['retention_days'] = 365;
            }
            return \GuzzleHttp\Promise\Create::promiseFor(new Response(200, ['Content-Type' => 'application/json'], json_encode($page, JSON_THROW_ON_ERROR)));
        });
        $stack->push(Middleware::history($history));
        $client = NoResponseClient::builder()->setClient(new Client(['handler' => $stack, 'http_errors' => false]))
            ->setSecurity('nrk_test_identifier_fixture')->setServerUrl('https://api.example.test')->build();
        $expected = ['scope' => 'assessment', 'expression' => ['and' => [
            ['term' => ['kind' => 'phone', 'value' => '+14155552671', 'match' => 'canonical']],
            ['or' => [['term' => ['kind' => 'email', 'value' => 'other@example.com', 'match' => 'exact']], ['term' => ['kind' => 'username', 'value' => 'janedoe', 'match' => 'canonical', 'namespace' => 'customer']]]],
        ]]];
        $accountExpected = [...$expected, 'scope' => 'account'];
        $accountQuery = \NoResponse\Utils\JSON::createSerializer()->deserialize(json_encode($accountExpected, JSON_THROW_ON_ERROR), Shared\IdentifierExpression::class, 'json');
        $assessmentQuery = \NoResponse\Utils\JSON::createSerializer()->deserialize(json_encode($expected, JSON_THROW_ON_ERROR), Shared\IdentifierExpression::class, 'json');
        $accounts = $client->accounts->search(new Shared\AccountDirectorySearchRequest(identifierExpression: $accountQuery))->result;
        $assessments = $client->assessments->search(new Shared\AssessmentSearchRequest(from: '2026-10-01T00:00:00Z', to: '2026-10-02T00:00:00Z', identifierExpression: $assessmentQuery))->result;
        foreach ([$accounts->items[0]->matchedIdentifiers, $assessments->items[0]->matchedIdentifiers] as $found) {
            self::assertCount(2, $found);
            self::assertSame(2, $found[1]->termIndex);
            $found = $found[1];
            self::assertInstanceOf(Shared\IdentifierTermMatch::class, $found);
            self::assertSame('JaneDoe', $found->value);
            self::assertSame($revision['id'], $found->assessmentId);
        }
        self::assertNull($accounts->items[0]->current);
        self::assertCount(2, $history);
        foreach ($history as $call) {
            self::assertSame('Bearer nrk_test_identifier_fixture', $call['request']->getHeaderLine('Authorization'));
            $sent = json_decode((string) $call['request']->getBody(), true, flags: JSON_THROW_ON_ERROR);
            $requestExpected = $call['request']->getUri()->getPath() === '/v1/accounts/search' ? $accountExpected : $expected;
            self::assertEquals($requestExpected, $sent['identifier_expression']);
        }
    }
}
