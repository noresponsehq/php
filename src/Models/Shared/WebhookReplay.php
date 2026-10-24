<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WebhookReplay - The 202 answer of POST /v1/webhooks/{endpoint_id}/deliveries/{event_id}/replay: the event queued to be sent again. */
class WebhookReplay
{
    /**
     * Opaque id of the endpoint registration.
     *
     * @var string $endpointId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('endpoint_id')]
    public string $endpointId;

    /**
     * The replayed event's id. The receiver sees the same id and body as the first time, with a new NR-Webhook-Timestamp and signature.
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
     * @param  string  $endpointId
     * @param  string  $eventId
     * @param  string  $eventType
     * @phpstan-pure
     */
    public function __construct(string $endpointId, string $eventId, string $eventType)
    {
        $this->endpointId = $endpointId;
        $this->eventId = $eventId;
        $this->eventType = $eventType;
    }
}