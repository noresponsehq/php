<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use NoResponse\Models\Shared\AccountDeletedEvent;
use NoResponse\Models\Shared\AccountRiskChangedEvent;
use NoResponse\Models\Shared\Assessment;
use NoResponse\Models\Shared\AssessmentUpdatedEvent;
use NoResponse\Models\Shared\EndpointVerificationEvent;
use NoResponse\Models\Shared\WebhookEndpointDisabledEvent;
use NoResponse\Models\Shared\WorkspaceDeletedEvent;
use NoResponse\Utils\JSON;
use NoResponse\WebhookVerification\Webhook;
use NoResponse\WebhookVerification\WebhookVerificationException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/** The contract's signature vector through the generated webhook verifier. */
final class WebhookVectorTest extends TestCase
{
    private const EVENT_CLASSES = [
        'assessment.updated' => AssessmentUpdatedEvent::class,
        'endpoint.verification' => EndpointVerificationEvent::class,
        'account.deleted' => AccountDeletedEvent::class,
        'workspace.deleted' => WorkspaceDeletedEvent::class,
        'webhook_endpoint.disabled' => WebhookEndpointDisabledEvent::class,
        'account.risk_changed' => AccountRiskChangedEvent::class,
    ];

    /** @return array{payload: string, headers: array<string, string>, key_id: string, secret_utf8: string, timestamp: string} */
    private static function vector(): array
    {
        return json_decode((string) file_get_contents(__DIR__.'/fixtures/webhook-signature-vector.json'), true, 512, JSON_THROW_ON_ERROR);
    }

    public function test_the_vector_verifies_into_a_typed_assessment_event(): void
    {
        $v = self::vector();
        $event = Webhook::constructEvent($v['payload'], $v['headers'], [$v['key_id'] => $v['secret_utf8']], now: (int) $v['timestamp']);
        $this->assertInstanceOf(AssessmentUpdatedEvent::class, $event);
        $this->assertSame('assessment.updated', $event->type);
        $this->assertInstanceOf(Assessment::class, $event->data);
        $this->assertSame('asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM', $event->data->id);
        $this->assertSame(2, $event->data->detail->assessmentVersion);
    }

    /** @return array<string, array{string, array<string, string>, array<string, string>, int, string}> */
    public static function refusals(): array
    {
        $v = self::vector();
        $secrets = [$v['key_id'] => $v['secret_utf8']];
        $now = (int) $v['timestamp'];
        $repeated = $v['headers'] + ['nr-webhook-signature' => $v['headers']['NR-Webhook-Signature']];
        $missingId = array_diff_key($v['headers'], ['NR-Webhook-Id' => true]);

        return [
            'trailing space' => [$v['payload'].' ', $v['headers'], $secrets, $now, WebhookVerificationException::INVALID_SIGNATURE],
            '301 s later' => [$v['payload'], $v['headers'], $secrets, $now + 301, WebhookVerificationException::INVALID_TIMESTAMP],
            'unknown key id' => [$v['payload'], $v['headers'], ['whk_other0001' => $v['secret_utf8']], $now, WebhookVerificationException::UNKNOWN_KEY],
            'repeated header' => [$v['payload'], $repeated, $secrets, $now, WebhookVerificationException::DUPLICATE_HEADER],
            'missing id' => [$v['payload'], $missingId, $secrets, $now, WebhookVerificationException::MISSING_HEADER],
        ];
    }

    /**
     * @param  array<string, string>  $headers
     * @param  array<string, string>  $secrets
     */
    #[DataProvider('refusals')]
    public function test_a_tampered_stale_unknown_or_repeated_delivery_is_refused(string $payload, array $headers, array $secrets, int $now, string $code): void
    {
        try {
            Webhook::constructEvent($payload, $headers, $secrets, now: $now);
            $this->fail('expected WebhookVerificationException');
        } catch (WebhookVerificationException $e) {
            $this->assertSame($code, $e->errorCode);
        }
    }

    /** @return array<string, array{string}> */
    public static function eventFixtures(): array
    {
        $cases = [];
        foreach (glob(__DIR__.'/fixtures/valid/webhook-*.json') ?: [] as $path) {
            $body = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
            if (isset($body['type'])) {
                $cases[basename($path)] = [$path];
            }
        }

        return $cases;
    }

    #[DataProvider('eventFixtures')]
    public function test_every_contract_event_fixture_parses_into_its_typed_event(string $path): void
    {
        $body = json_decode((string) file_get_contents($path), false, 512, JSON_THROW_ON_ERROR);
        $raw = json_encode($body, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
        $now = 1791968402;
        $headers = [
            'NR-Webhook-Id' => $body->id,
            'NR-Webhook-Timestamp' => (string) $now,
            'NR-Webhook-Key-Id' => 'whk_fixture0001',
            'NR-Webhook-Signature' => 'v1='.hash_hmac('sha256', $now.'.'.$raw, 'fixture-secret'),
        ];
        $event = Webhook::constructEvent($raw, $headers, ['whk_fixture0001' => 'fixture-secret'], now: $now);
        $this->assertSame($body->type, $event->type);
        $this->assertInstanceOf(self::EVENT_CLASSES[$body->type], $event);
        $typed = json_decode(JSON::createSerializer()->serialize($event, 'json'), true, 512, JSON_THROW_ON_ERROR);
        $this->assertEquals(json_decode($raw, true, 512, JSON_THROW_ON_ERROR), $typed);
    }
}
