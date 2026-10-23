<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ReplayWebhookDeliveryRequest
{
    /**
     * The endpoint's whe_ id. An id that is unknown, malformed or another tenant's answers 404.
     *
     * @var string $endpointId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=endpoint_id')]
    public string $endpointId;

    /**
     * The evt_ id of a delivery the endpoint's log holds, as GET /v1/webhooks/{endpoint_id}/deliveries lists it. An id that is malformed, not sent to this endpoint, past the log's retention or another tenant's answers 404.
     *
     * @var string $eventId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=event_id')]
    public string $eventId;

    /**
     *
     * @var \NoResponse\Models\Shared\WebhookReplayRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\WebhookReplayRequest $body;

    /**
     * @param  string  $endpointId
     * @param  string  $eventId
     * @param  \NoResponse\Models\Shared\WebhookReplayRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $endpointId, string $eventId, Shared\WebhookReplayRequest $body)
    {
        $this->endpointId = $endpointId;
        $this->eventId = $eventId;
        $this->body = $body;
    }
}