<?php

declare(strict_types=1);

namespace NoResponse\WebhookVerification;

use NoResponse\Utils\JSON;
use NoResponse\Serializer\DeserializationContext;

final class Webhook
{
    /** How far the NR-Webhook-Timestamp header may be from the receiver's clock, in seconds. */
    public const DEFAULT_TOLERANCE_SECONDS = 300;

    private const HEADERS = [
        'NR-Webhook-Id',
        'NR-Webhook-Timestamp',
        'NR-Webhook-Key-Id',
        'NR-Webhook-Signature',
    ];

    private const EVENT_TYPES = [
        'assessment.updated' => \NoResponse\Models\Shared\AssessmentUpdatedEvent::class,
        'endpoint.verification' => \NoResponse\Models\Shared\EndpointVerificationEvent::class,
        'account.deleted' => \NoResponse\Models\Shared\AccountDeletedEvent::class,
        'workspace.deleted' => \NoResponse\Models\Shared\WorkspaceDeletedEvent::class,
        'webhook_endpoint.disabled' => \NoResponse\Models\Shared\WebhookEndpointDisabledEvent::class,
        'account.risk_changed' => \NoResponse\Models\Shared\AccountRiskChangedEvent::class,
        'audit.event' => \NoResponse\Models\Shared\AuditEventEvent::class,
    ];

    /**
     * Verifies a webhook delivery and parses its body.
     *
     * $payload is the raw request body exactly as received: re-encoding parsed JSON breaks the signature.
     * $headers maps header names to a value or a list of values, as PSR-7 getHeaders() and Symfony's
     * $request->headers->all() return them. A header repeated in any letter case, or sent as a
     * comma-joined list, is refused.
     * $secrets maps each key id, sent in NR-Webhook-Key-Id, to its secret, so a receiver can hold two during a rotation.
     * $now is the receiver's clock in Unix seconds; it defaults to time().
     *
     * @param  array<string, string|array<string>>  $headers
     * @param  array<string, string>  $secrets
     *
     * @throws WebhookVerificationException
     */
    public static function constructEvent(
        string $payload,
        array $headers,
        array $secrets,
        int $toleranceSeconds = self::DEFAULT_TOLERANCE_SECONDS,
        ?int $now = null,
    ): \NoResponse\Models\Shared\AssessmentUpdatedEvent|\NoResponse\Models\Shared\EndpointVerificationEvent|\NoResponse\Models\Shared\AccountDeletedEvent|\NoResponse\Models\Shared\WorkspaceDeletedEvent|\NoResponse\Models\Shared\WebhookEndpointDisabledEvent|\NoResponse\Models\Shared\AccountRiskChangedEvent|\NoResponse\Models\Shared\AuditEventEvent {
        $values = self::headerValues($headers);
        $id = $values['NR-Webhook-Id'];
        $timestamp = $values['NR-Webhook-Timestamp'];
        $keyId = $values['NR-Webhook-Key-Id'];
        $signature = $values['NR-Webhook-Signature'];

        if (preg_match('/\A[0-9]{1,12}\z/', $timestamp) !== 1) {
            throw new WebhookVerificationException(WebhookVerificationException::INVALID_TIMESTAMP, 'NR-Webhook-Timestamp is not a Unix time in seconds');
        }
        if (abs(($now ?? time()) - (int) $timestamp) > $toleranceSeconds) {
            throw new WebhookVerificationException(WebhookVerificationException::INVALID_TIMESTAMP, 'NR-Webhook-Timestamp is outside the tolerance');
        }

        if (! array_key_exists($keyId, $secrets)) {
            throw new WebhookVerificationException(WebhookVerificationException::UNKNOWN_KEY, 'NR-Webhook-Key-Id names a key this receiver does not hold');
        }
        $secret = $secrets[$keyId];
        if ($secret === '') {
            throw new WebhookVerificationException(WebhookVerificationException::INVALID_SIGNATURE, 'the webhook secret is empty');
        }

        $received = self::decodeSignature($signature);
        $substitutions = ['{timestamp}' => $timestamp, '{id}' => $id];
        $signed = strtr('{timestamp}.', $substitutions).$payload;
        if ($received === null || ! hash_equals(hash_hmac('sha256', $signed, $secret, true), $received)) {
            throw new WebhookVerificationException(WebhookVerificationException::INVALID_SIGNATURE, 'NR-Webhook-Signature does not match');
        }

        try {
            $body = json_decode($payload, false, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            throw new WebhookVerificationException(WebhookVerificationException::INVALID_PAYLOAD, 'the body is not JSON');
        }
        if (! $body instanceof \stdClass) {
            throw new WebhookVerificationException(WebhookVerificationException::INVALID_PAYLOAD, 'the body is not a JSON object');
        }
        if (($body->{'id'} ?? null) !== $id) {
            throw new WebhookVerificationException(WebhookVerificationException::INVALID_PAYLOAD, 'the body\'s id does not equal NR-Webhook-Id');
        }
        $eventType = $body->{'type'} ?? null;
        if (! is_string($eventType) || ! array_key_exists($eventType, self::EVENT_TYPES)) {
            throw new WebhookVerificationException(WebhookVerificationException::INVALID_PAYLOAD, 'the body is not a known webhook event');
        }
        $class = self::EVENT_TYPES[$eventType];

        try {
            $event = JSON::createSerializer()->deserialize($payload, $class, 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
        } catch (\Throwable) {
            throw new WebhookVerificationException(WebhookVerificationException::INVALID_PAYLOAD, 'the body is not a known webhook event');
        }
        if (! $event instanceof \NoResponse\Models\Shared\AssessmentUpdatedEvent && ! $event instanceof \NoResponse\Models\Shared\EndpointVerificationEvent && ! $event instanceof \NoResponse\Models\Shared\AccountDeletedEvent && ! $event instanceof \NoResponse\Models\Shared\WorkspaceDeletedEvent && ! $event instanceof \NoResponse\Models\Shared\WebhookEndpointDisabledEvent && ! $event instanceof \NoResponse\Models\Shared\AccountRiskChangedEvent && ! $event instanceof \NoResponse\Models\Shared\AuditEventEvent) {
            throw new WebhookVerificationException(WebhookVerificationException::INVALID_PAYLOAD, 'the body is not a known webhook event');
        }

        return $event;
    }

    /**
     * @param  array<string, string|array<string>>  $headers
     * @return array<string, string>
     */
    private static function headerValues(array $headers): array
    {
        $values = [];
        foreach (self::HEADERS as $name) {
            $found = [];
            foreach ($headers as $key => $value) {
                if (strcasecmp((string) $key, $name) === 0) {
                    array_push($found, ...(is_array($value) ? array_values($value) : [$value]));
                }
            }
            if (count($found) > 1 || (count($found) === 1 && str_contains($found[0], ','))) {
                throw new WebhookVerificationException(WebhookVerificationException::DUPLICATE_HEADER, $name.' is repeated');
            }
            if (count($found) === 0 || $found[0] === '') {
                throw new WebhookVerificationException(WebhookVerificationException::MISSING_HEADER, $name.' is missing');
            }
            $values[$name] = $found[0];
        }

        return $values;
    }

    private static function decodeSignature(string $signature): ?string
    {
        if (! str_starts_with($signature, 'v1=')) {
            return null;
        }
        $encoded = substr($signature, strlen('v1='));
        if (preg_match('/\A(?:[0-9A-Fa-f]{2})*\z/', $encoded) !== 1) {
            return null;
        }
        $decoded = hex2bin($encoded);

        return $decoded === false ? null : $decoded;
    }
}
