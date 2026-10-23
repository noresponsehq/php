<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use NoResponse\Models\Shared;
use NoResponse\NoResponseClient;
use PHPUnit\Framework\TestCase;

/**
 * Smoke test of the client against the mock server.
 *
 * Skipped unless NORESPONSE_MOCK_URL names a running mock server
 * (`generate_sdks.py mockserver --serve`). The mock server answers with the
 * examples in the SDK document, so this proves the client's wiring (URL, auth
 * header, request encoding, response parsing) and nothing about the live API.
 */
final class MockServerTest extends TestCase
{
    private static function client(): NoResponseClient
    {
        $url = getenv('NORESPONSE_MOCK_URL');
        if ($url === false || $url === '') {
            self::markTestSkipped('set NORESPONSE_MOCK_URL to a running mock server');
        }

        return NoResponseClient::builder()
            ->setSecurity('nrk_mock_'.str_repeat('k', 20))
            ->setServerUrl($url)
            ->build();
    }

    public function testCreateReturnsTheDocumentedAssessment(): void
    {
        $response = self::client()->assessments->create(
            idempotencyKey: 'mock-server-smoke-0001',
            body: new Shared\AssessmentRequest(
                accountId: 'acct_7f3a9c',
                flow: Shared\Flow::AccountCreation,
                identifiers: new Shared\AssessmentRequestIdentifiers(email: 'new.user@example.com'),
            ),
        );

        self::assertStringStartsWith('asm_', $response->result->id);
        self::assertSame('acct_7f3a9c', $response->result->detail->accountId);
    }

    public function testGetReturnsTheDocumentedAssessment(): void
    {
        $response = self::client()->assessments->get('asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM');

        self::assertStringStartsWith('asm_', $response->result->id);
        self::assertSame($response->result->id, $response->result->detail->assessmentId);
    }
}
