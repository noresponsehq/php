<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use NoResponse\Models\Shared\Assessment;
use NoResponse\Models\Shared\Recommendation;
use NoResponse\Webhooks\AssessmentExpired;
use NoResponse\Webhooks\EndpointVerification;
use NoResponse\Webhooks\VerificationException;
use NoResponse\Webhooks\Webhook;
use PHPUnit\Framework\TestCase;

final class WebhookTest extends TestCase
{
    private const NOW = 1791968402;

    /** @return array<string, mixed> */
    private static function fixture(string $name): array
    {
        return json_decode((string) file_get_contents(__DIR__.'/fixtures/'.$name), true, 512, JSON_THROW_ON_ERROR);
    }

    /** @return array{string, array<string, string>, array<string, string>} */
    private static function vector(): array
    {
        $v = self::fixture('webhook-signature-vector.json');

        return [$v['payload'], $v['headers'], [$v['key_id'] => $v['secret_utf8']]];
    }

    /**
     * @param  array<string, mixed>  $body
     * @return array{string, array<string, string>}
     */
    private static function signed(array $body, string $secret, string $id, string $keyId = 'whk_sdktest01'): array
    {
        $raw = json_encode($body, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
        $stamp = (string) self::NOW;

        return [$raw, [
            'NR-Webhook-Id' => $id,
            'NR-Webhook-Timestamp' => $stamp,
            'NR-Webhook-Key-Id' => $keyId,
            'NR-Webhook-Signature' => 'v1='.hash_hmac('sha256', $stamp.'.'.$raw, $secret),
        ]];
    }

    /** @param  array<mixed>  $headers */
    private function refused(string $code, string $payload, array $headers, array $secrets, int $now = self::NOW): void
    {
        try {
            Webhook::constructEvent($payload, $headers, $secrets, now: $now);
            $this->fail("expected {$code}");
        } catch (VerificationException $e) {
            $this->assertSame($code, $e->errorCode, $e->getMessage());
        }
    }

    public function test_shared_vector_yields_typed_assessment(): void
    {
        [$payload, $headers, $secrets] = self::vector();
        $event = Webhook::constructEvent($payload, $headers, $secrets, now: self::NOW);
        $this->assertSame('assessment.updated', $event->type);
        $this->assertSame($headers['NR-Webhook-Id'], $event->id);
        $this->assertSame('2026-10-14T09:00:02.000Z', $event->createdAt);
        $this->assertInstanceOf(Assessment::class, $event->data);
        $this->assertSame('asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM', $event->data->assessmentId);
        $this->assertSame(2, $event->data->assessmentVersion);
        $this->assertSame(Recommendation::StepUp, $event->data->risk?->recommendation);
        $this->assertFalse($event->isExpired());
        // PSR-7 style lists of values, in lower case, verify the same delivery.
        $psr = [];
        foreach ($headers as $name => $value) {
            $psr[strtolower($name)] = [$value];
        }
        $this->assertSame($event->id, Webhook::constructEvent($payload, $psr, $secrets, now: self::NOW)->id);
    }

    public function test_refusals(): void
    {
        [$payload, $headers, $secrets] = self::vector();
        $this->refused('invalid_signature', $payload.' ', $headers, $secrets);
        $this->refused('invalid_timestamp', $payload, $headers, $secrets, self::NOW + 301);
        $this->refused('invalid_timestamp', $payload, $headers, $secrets, self::NOW - 301);
        $this->assertSame($headers['NR-Webhook-Id'], Webhook::constructEvent($payload, $headers, $secrets, 600, self::NOW + 301)->id);
        $this->refused('duplicate_header', $payload, $headers + ['nr-webhook-id' => 'duplicate'], $secrets);
        $this->refused('duplicate_header', $payload, ['NR-Webhook-Id' => [$headers['NR-Webhook-Id'], $headers['NR-Webhook-Id']]] + $headers, $secrets);
        $missing = $headers;
        unset($missing['NR-Webhook-Signature']);
        $this->refused('missing_header', $payload, $missing, $secrets);
        $this->refused('unknown_key', $payload, $headers, ['whk_other0001' => reset($secrets)]);
        $this->refused('invalid_signature', $payload, $headers, [array_key_first($secrets) => 'other-secret']);
        $this->refused('invalid_signature', $payload, ['NR-Webhook-Signature' => 'v2=abc'] + $headers, $secrets);
    }

    public function test_rotation_and_event_id(): void
    {
        $complete = self::fixture('valid/assessment-complete.json');
        $event = ['id' => 'evt_01JA2ZB4N5P6Q7R8S9T0VWXYZ2', 'type' => 'assessment.updated', 'created_at' => '2026-10-18T11:00:04Z', 'data' => $complete];
        $both = ['whk_sdktest01' => 'old-secret', 'whk_sdktest02' => 'new-secret'];
        [$raw, $headers] = self::signed($event, 'new-secret', $event['id'], 'whk_sdktest02');
        $verified = Webhook::constructEvent($raw, $headers, $both, now: self::NOW);
        $this->assertInstanceOf(Assessment::class, $verified->data);
        $this->assertSame($complete['assessment_id'], $verified->data->assessmentId);
        [$raw, $headers] = self::signed($event, 'new-secret', 'evt_01JA2ZB4N5P6Q7R8S9T0VWXYZ9', 'whk_sdktest02');
        $this->refused('invalid_payload', $raw, $headers, $both);
        $pointer = ['data' => ['assessment_id' => $complete['assessment_id'], 'assessment_url' => '/v1/assessments/x']] + $event;
        [$raw, $headers] = self::signed($pointer, 'new-secret', $event['id'], 'whk_sdktest02');
        $this->refused('invalid_payload', $raw, $headers, $both);
    }

    public function test_expired_and_verification_events(): void
    {
        $expired = self::fixture('valid/webhook-assessment-expired.json');
        [$raw, $headers] = self::signed($expired, 'secret', $expired['id']);
        $event = Webhook::constructEvent($raw, $headers, ['whk_sdktest01' => 'secret'], now: self::NOW);
        $this->assertTrue($event->isExpired());
        $this->assertEquals(new AssessmentExpired($expired['data']['assessment_id'], $expired['data']['account_id'], 2), $event->data);
        $this->expectException(VerificationException::class);
        try {
            Webhook::verificationResponse($event);
        } finally {
            $ping = self::fixture('valid/webhook-endpoint-verification.json');
            [$raw, $headers] = self::signed($ping, 'secret', $ping['id']);
            $verification = Webhook::constructEvent($raw, $headers, ['whk_sdktest01' => 'secret'], now: self::NOW);
            $this->assertSame('endpoint.verification', $verification->type);
            $this->assertEquals(new EndpointVerification($ping['data']['endpoint_id'], $ping['data']['challenge']), $verification->data);
            $this->assertSame(['challenge' => $ping['data']['challenge']], Webhook::verificationResponse($verification));
        }
    }

    public function test_the_test_flag_marks_only_a_test_assessment_event(): void
    {
        $secrets = ['whk_sdktest01' => 'secret'];
        $real = self::fixture('valid/webhook-assessment-updated.json');
        [$raw, $headers] = self::signed($real, 'secret', $real['id']);
        $this->assertFalse(Webhook::constructEvent($raw, $headers, $secrets, now: self::NOW)->test);

        $sample = ['test' => true] + $real;
        [$raw, $headers] = self::signed($sample, 'secret', $sample['id']);
        $event = Webhook::constructEvent($raw, $headers, $secrets, now: self::NOW);
        $this->assertTrue($event->test);
        $this->assertInstanceOf(Assessment::class, $event->data);

        $notTrue = ['test' => 'true'] + $real;
        [$raw, $headers] = self::signed($notTrue, 'secret', $notTrue['id']);
        $this->assertFalse(Webhook::constructEvent($raw, $headers, $secrets, now: self::NOW)->test);

        // A verification ping must still be echoed, so it never reads as a test event.
        $ping = ['test' => true] + self::fixture('valid/webhook-endpoint-verification.json');
        [$raw, $headers] = self::signed($ping, 'secret', $ping['id']);
        $this->assertFalse(Webhook::constructEvent($raw, $headers, $secrets, now: self::NOW)->test);
    }

    public function test_an_empty_summary_object_stays_an_object(): void
    {
        $body = self::fixture('valid/webhook-assessment-updated.json');
        $body['data']['risk']['summary']['email'] = new \stdClass;
        [$raw, $headers] = self::signed($body, 'secret', $body['id']);
        $event = Webhook::constructEvent($raw, $headers, ['whk_sdktest01' => 'secret'], now: self::NOW);
        $this->assertInstanceOf(\NoResponse\Models\Shared\Assessment::class, $event->data);
    }

    // The API adds fields without a new version, so keys this SDK does not know
    // must not stop a signed event from verifying.
    public function test_unknown_fields_are_accepted(): void
    {
        foreach ([
            'invalid/webhook-tenant-id.json',
            'invalid/webhook-identifier-leak.json',
            'invalid/webhook-expired-with-assessment-url.json',
        ] as $name) {
            $body = self::fixture($name);
            [$raw, $headers] = self::signed($body, 'secret', $body['id']);
            $this->assertSame($body['id'], Webhook::constructEvent($raw, $headers, ['whk_sdktest01' => 'secret'], now: self::NOW)->id);
        }
    }

    public function test_contract_invalid_fixtures_and_malformed_identifiers_are_refused(): void
    {
        $secrets = ['whk_sdktest01' => 'secret'];
        foreach ([
            'invalid/webhook-update-names-source.json',
            'invalid/webhook-unknown-event-type.json',
            'invalid/webhook-update-pointer-only.json',
            'invalid/webhook-update-with-expired-status.json',
            'invalid/webhook-verification-without-challenge.json',
        ] as $name) {
            $body = self::fixture($name);
            [$raw, $headers] = self::signed($body, 'secret', $body['id']);
            $this->refused('invalid_payload', $raw, $headers, $secrets);
        }

        $endpoint = self::fixture('valid/webhook-endpoint-verification.json');
        $endpoint['id'] = 'evt_bad';
        [$raw, $headers] = self::signed($endpoint, 'secret', 'evt_bad');
        $this->refused('invalid_payload', $raw, $headers, $secrets);

        $endpoint = self::fixture('valid/webhook-endpoint-verification.json');
        $endpoint['data']['endpoint_id'] = 'whe_bad';
        [$raw, $headers] = self::signed($endpoint, 'secret', $endpoint['id']);
        $this->refused('invalid_payload', $raw, $headers, $secrets);

        $endpoint = self::fixture('valid/webhook-endpoint-verification.json');
        $endpoint['created_at'] = 'tomorrow';
        [$raw, $headers] = self::signed($endpoint, 'secret', $endpoint['id']);
        $this->refused('invalid_payload', $raw, $headers, $secrets);

        $endpoint = self::fixture('valid/webhook-endpoint-verification.json');
        $endpoint['created_at'] = '2026-10-14';
        [$raw, $headers] = self::signed($endpoint, 'secret', $endpoint['id']);
        $this->refused('invalid_payload', $raw, $headers, $secrets);
    }
}
