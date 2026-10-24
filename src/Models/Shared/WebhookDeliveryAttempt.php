<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class WebhookDeliveryAttempt
{
    /**
     * The event id the receiver saw as NR-Webhook-Id and as the body's id. Replay it with POST /v1/webhooks/{endpoint_id}/deliveries/{event_id}/replay.
     *
     * @var string $eventId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('event_id')]
    public string $eventId;

    /**
     * The event's type, as its body's type: assessment.updated, endpoint.verification, account.deleted, workspace.deleted, webhook_endpoint.disabled, account.risk_changed, or a type added later.
     *
     * @var string $eventType
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('event_type')]
    public string $eventType;

    /**
     * Which attempt of this delivery this was: 1 for the first send, up to 9 with retries. A replay counts its own attempts from 1.
     *
     * @var int $attempt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attempt')]
    public int $attempt;

    /**
     * true for an attempt of a replay you asked for.
     *
     * @var bool $replay
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('replay')]
    public bool $replay;

    /**
     * delivered when the endpoint answered 2xx; failed otherwise, with failure naming why.
     *
     * @var \NoResponse\Models\Shared\WebhookDeliveryAttemptStatus $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\WebhookDeliveryAttemptStatus')]
    public WebhookDeliveryAttemptStatus $status;

    /**
     * Milliseconds from sending the request to the answer or the failure.
     *
     * @var int $latencyMs
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('latency_ms')]
    public int $latencyMs;

    /**
     * When the request was sent. Its NR-Webhook-Timestamp is this time in Unix seconds.
     *
     * @var string $attemptedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attempted_at')]
    public string $attemptedAt;

    /**
     * The HTTP status the endpoint answered. Absent when no response was read.
     *
     * @var ?int $responseCode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('response_code')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $responseCode = null;

    /**
     * Why the attempt failed: the URL is no longer valid, the host did not resolve, it resolved to an address that is not public, no answer within 5 seconds, the connection failed, a 3xx (redirects are not followed) or another non-2xx status. Absent for a delivered attempt.
     *
     * @var ?\NoResponse\Models\Shared\Failure $failure
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('failure')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Failure|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?Failure $failure = null;

    /**
     * @param  string  $eventId
     * @param  string  $eventType
     * @param  int  $attempt
     * @param  bool  $replay
     * @param  \NoResponse\Models\Shared\WebhookDeliveryAttemptStatus  $status
     * @param  int  $latencyMs
     * @param  string  $attemptedAt
     * @param  ?int  $responseCode
     * @param  ?\NoResponse\Models\Shared\Failure  $failure
     * @phpstan-pure
     */
    public function __construct(string $eventId, string $eventType, int $attempt, bool $replay, WebhookDeliveryAttemptStatus $status, int $latencyMs, string $attemptedAt, ?int $responseCode = null, ?Failure $failure = null)
    {
        $this->eventId = $eventId;
        $this->eventType = $eventType;
        $this->attempt = $attempt;
        $this->replay = $replay;
        $this->status = $status;
        $this->latencyMs = $latencyMs;
        $this->attemptedAt = $attemptedAt;
        $this->responseCode = $responseCode;
        $this->failure = $failure;
    }
}