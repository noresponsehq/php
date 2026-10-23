<?php

declare(strict_types=1);

namespace NoResponse\Webhooks;

use NoResponse\Models\Shared\Assessment;
use NoResponse\Utils\JSON;
use NoResponse\Serializer\DeserializationContext;

/**
 * Webhook verification. Hand-written beside the generated client.
 *
 * Verify the exact bytes received: the signature is HMAC-SHA256 over
 * "<timestamp>.<raw body>", so re-encoding parsed JSON breaks it.
 */
final class Webhook
{
    public const DEFAULT_TOLERANCE_SECONDS = 300;

    private const REQUIRED = ['nr-webhook-id', 'nr-webhook-timestamp', 'nr-webhook-key-id', 'nr-webhook-signature'];
    private const EVENT_ID = '/\Aevt_[0-9A-HJKMNP-TV-Z]{26}\z/';
    private const ASSESSMENT_ID = '/\Aasm_[0-9A-HJKMNP-TV-Z]{26}\z/';
    private const ACCOUNT_ID = '/\A[A-Za-z0-9][A-Za-z0-9._:|-]{0,127}\z/';
    private const ENDPOINT_ID = '/\Awhe_[0-9A-HJKMNP-TV-Z]{26}\z/';
    private const WORKSPACE_ID = '/\A[A-Za-z0-9][A-Za-z0-9_.-]{0,122}\z/';
    private const DATETIME = '/\A\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}(?:\.\d+)?(?:Z|[+-]\d{2}:\d{2})\z/';

    /**
     * Verify one delivery and return the typed Event.
     *
     * $payload is the raw request body. $headers maps header names to a value
     * or a list of values, as PSR-7 getHeaders() and Symfony's
     * $request->headers->all() return them; each NR-Webhook-* header must
     * appear exactly once, in any letter case. $secrets maps each whk_ key id
     * NoResponse gave you to its secret, so two can be held during a rotation.
     *
     * @param  array<string, string|array<string>>  $headers
     * @param  array<string, string>  $secrets
     *
     * @throws VerificationException
     */
    public static function constructEvent(
        string $payload,
        array $headers,
        array $secrets,
        int $toleranceSeconds = self::DEFAULT_TOLERANCE_SECONDS,
        ?int $now = null,
    ): Event {
        $found = self::collect($headers);
        $timestamp = $found['nr-webhook-timestamp'];
        $now ??= time();
        if (preg_match('/\A[0-9]{1,12}\z/', $timestamp) !== 1 || abs($now - (int) $timestamp) > $toleranceSeconds) {
            throw new VerificationException('invalid_timestamp', 'Webhook timestamp is outside the replay window');
        }
        $keyId = $found['nr-webhook-key-id'];
        if (preg_match('/\Awhk_[A-Za-z0-9]{8,64}\z/', $keyId) !== 1 || ! array_key_exists($keyId, $secrets)) {
            throw new VerificationException('unknown_key', 'Webhook key id is not one this receiver holds');
        }
        $signature = $found['nr-webhook-signature'];
        if (preg_match('/\Av1=[0-9a-f]{64}\z/', $signature) !== 1) {
            throw new VerificationException('invalid_signature', 'Webhook signature is malformed');
        }
        $expected = hash_hmac('sha256', $timestamp.'.'.$payload, $secrets[$keyId]);
        if (! hash_equals($expected, substr($signature, 3))) {
            throw new VerificationException('invalid_signature', 'Webhook signature does not match');
        }

        return self::event($payload, $found['nr-webhook-id']);
    }

    /**
     * The body to answer an endpoint.verification event with, as JSON, status 200.
     *
     * @return array{challenge: string}
     *
     * @throws VerificationException
     */
    public static function verificationResponse(Event $event): array
    {
        if (! $event->data instanceof EndpointVerification) {
            throw new VerificationException('invalid_payload', 'Not an endpoint.verification event');
        }

        return ['challenge' => $event->data->challenge];
    }

    /**
     * @param  array<string, string|array<string>>  $headers
     * @return array<string, string>
     */
    private static function collect(array $headers): array
    {
        $found = [];
        foreach ($headers as $name => $value) {
            $key = strtolower((string) $name);
            if (! in_array($key, self::REQUIRED, true)) {
                continue;
            }
            $values = is_array($value) ? array_values($value) : [$value];
            if (count($values) !== 1 || array_key_exists($key, $found)) {
                throw new VerificationException('duplicate_header', "Webhook header {$key} is repeated");
            }
            $found[$key] = (string) $values[0];
        }
        foreach (self::REQUIRED as $key) {
            if (($found[$key] ?? '') === '') {
                throw new VerificationException('missing_header', "Webhook header {$key} is missing");
            }
        }

        return $found;
    }

    private static function event(string $payload, string $headerId): Event
    {
        try {
            $body = json_decode($payload, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            throw new VerificationException('invalid_payload', 'Webhook body is not JSON');
        }
        if (! is_array($body)) {
            throw new VerificationException('invalid_payload', 'Webhook event id does not match NR-Webhook-Id');
        }
        /** @var array<string, mixed> $body */
        $bodyId = $body['id'] ?? null;
        if (! is_string($bodyId)
            || $bodyId !== $headerId
            || preg_match(self::EVENT_ID, $bodyId) !== 1) {
            throw new VerificationException('invalid_payload', 'Webhook event id does not match NR-Webhook-Id');
        }
        $createdAt = $body['created_at'] ?? null;
        $data = $body['data'] ?? null;
        $type = $body['type'] ?? null;
        if (! is_string($createdAt) || preg_match(self::DATETIME, $createdAt) !== 1 || ! is_array($data) || ! is_string($type)) {
            throw new VerificationException('invalid_payload', 'Webhook event envelope is malformed');
        }

        $test = ($body['test'] ?? null) === true && $type === 'assessment.updated';

        return new Event($headerId, $type, $createdAt, self::data($type, $data), $test);
    }

    /**
     * @param  array<mixed>  $data
     */
    private static function data(string $type, array $data): Assessment|AssessmentExpired|EndpointVerification|AccountDeleted|TenantDeleted|EndpointDisabled
    {
        if ($type === 'endpoint.verification') {
            $endpointId = $data['endpoint_id'] ?? null;
            $challenge = $data['challenge'] ?? null;
            if (! is_string($endpointId)
                || preg_match(self::ENDPOINT_ID, $endpointId) !== 1 || ! is_string($challenge)
                || preg_match('/\A[A-Za-z0-9_-]{43}\z/', $challenge) !== 1) {
                throw new VerificationException('invalid_payload', 'Endpoint verification event is malformed');
            }

            return new EndpointVerification($endpointId, $challenge);
        }
        if ($type === 'account.deleted') {
            $accountId = $data['account_id'] ?? null;
            $deleted = $data['assessments_deleted'] ?? null;
            $deletedAt = $data['deleted_at'] ?? null;
            if (! is_string($accountId) || preg_match(self::ACCOUNT_ID, $accountId) !== 1
                || ! is_int($deleted) || $deleted < 1
                || ! is_string($deletedAt) || preg_match(self::DATETIME, $deletedAt) !== 1) {
                throw new VerificationException('invalid_payload', 'Account deleted event is malformed');
            }

            return new AccountDeleted($accountId, $deleted, $deletedAt);
        }
        if ($type === 'tenant.deleted') {
            $workspaceId = $data['workspace_id'] ?? null;
            $environment = $data['environment'] ?? null;
            $deletedAt = $data['deleted_at'] ?? null;
            if (! is_string($workspaceId) || preg_match(self::WORKSPACE_ID, $workspaceId) !== 1
                || ($environment !== 'live' && $environment !== 'test')
                || ! is_string($deletedAt) || preg_match(self::DATETIME, $deletedAt) !== 1) {
                throw new VerificationException('invalid_payload', 'Tenant deleted event is malformed');
            }

            return new TenantDeleted($workspaceId, $environment, $deletedAt);
        }
        if ($type === 'webhook_endpoint.disabled') {
            $endpointId = $data['endpoint_id'] ?? null;
            $failingSince = $data['failing_since'] ?? null;
            $disabledAt = $data['disabled_at'] ?? null;
            if (! is_string($endpointId) || preg_match(self::ENDPOINT_ID, $endpointId) !== 1
                || ! is_string($failingSince) || preg_match(self::DATETIME, $failingSince) !== 1
                || ! is_string($disabledAt) || preg_match(self::DATETIME, $disabledAt) !== 1) {
                throw new VerificationException('invalid_payload', 'Endpoint disabled event is malformed');
            }

            return new EndpointDisabled($endpointId, $failingSince, $disabledAt);
        }
        if ($type !== 'assessment.updated') {
            throw new VerificationException('invalid_payload', 'Unknown webhook event type');
        }
        if (($data['status'] ?? null) === 'expired') {
            $assessmentId = $data['assessment_id'] ?? null;
            $accountId = $data['account_id'] ?? null;
            $version = $data['assessment_version'] ?? null;
            if (! is_string($assessmentId)
                || preg_match(self::ASSESSMENT_ID, $assessmentId) !== 1 || ! is_string($accountId)
                || preg_match(self::ACCOUNT_ID, $accountId) !== 1 || ! is_int($version) || $version < 1
                || ($data['change_reason'] ?? null) !== 'expired') {
                throw new VerificationException('invalid_payload', 'Expired assessment event is malformed');
            }

            return new AssessmentExpired($assessmentId, $accountId, $version);
        }
        try {
            $assessment = JSON::createSerializer()->deserialize(
                json_encode($data, JSON_THROW_ON_ERROR),
                Assessment::class,
                'json',
                DeserializationContext::create()->setRequireAllRequiredProperties(true),
            );
        } catch (\Throwable) {
            throw new VerificationException('invalid_payload', 'Webhook data is not an assessment');
        }
        if (! $assessment instanceof Assessment) {
            throw new VerificationException('invalid_payload', 'Webhook data is not an assessment');
        }

        return $assessment;
    }
}
