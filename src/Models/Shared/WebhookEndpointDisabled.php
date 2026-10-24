<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WebhookEndpointDisabled - One of the environment's endpoints stopped receiving events: every delivery attempt to it failed from failing_since until disabled_at, 72 hours or more. Its queued deliveries are dropped. Fix the receiver and verify it again with POST /v1/webhooks/{endpoint_id}/test (type endpoint.verification) to resume delivery. */
class WebhookEndpointDisabled
{
    /**
     * The endpoint that was disabled.
     *
     * @var string $endpointId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('endpoint_id')]
    public string $endpointId;

    /**
     * The first failed attempt of the unbroken failure streak.
     *
     * @var string $failingSince
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('failing_since')]
    public string $failingSince;

    /**
     * When the endpoint was disabled; equal to the event's created_at.
     *
     * @var string $disabledAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('disabled_at')]
    public string $disabledAt;

    /**
     * @param  string  $endpointId
     * @param  string  $failingSince
     * @param  string  $disabledAt
     * @phpstan-pure
     */
    public function __construct(string $endpointId, string $failingSince, string $disabledAt)
    {
        $this->endpointId = $endpointId;
        $this->failingSince = $failingSince;
        $this->disabledAt = $disabledAt;
    }
}