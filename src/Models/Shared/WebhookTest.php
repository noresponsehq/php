<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WebhookTest - The 202 answer of POST /v1/webhooks/{endpoint_id}/test: the event that was sent or queued. */
class WebhookTest
{
    /**
     * The event id the receiver sees as NR-Webhook-Id and as the body's id.
     *
     * @var string $deliveryId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('delivery_id')]
    public string $deliveryId;

    /**
     * Opaque id of the endpoint registration.
     *
     * @var string $endpointId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('endpoint_id')]
    public string $endpointId;

    /**
     * endpoint.verification sends a fresh challenge now, in this call, and the endpoint is verified if it echoes it. assessment.updated queues an event whose data is a fixed example assessment, with test true, delivered and retried like any other; the endpoint must be verified.
     *
     * @var \NoResponse\Models\Shared\WebhookTestRequestEvent|string $event
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('event')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\WebhookTestRequestEvent|string')]
    public WebhookTestRequestEvent|string $event;

    /**
     * unverified until the endpoint echoes an endpoint.verification challenge (send one with POST /v1/webhooks/{endpoint_id}/test); verified receives assessment.updated events; disabled after 72 hours of continuous delivery failure, and verified again by the same challenge.
     *
     * @var \NoResponse\Models\Shared\WebhookEndpointState|string $state
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('state')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\WebhookEndpointState|string')]
    public WebhookEndpointState|string $state;

    /**
     * endpoint.verification only: true when the endpoint echoed the challenge within 5 seconds. A false answer leaves the endpoint's state as it was.
     *
     * @var ?bool $verified
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('verified')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $verified = null;

    /**
     * @param  string  $deliveryId
     * @param  string  $endpointId
     * @param  \NoResponse\Models\Shared\WebhookTestRequestEvent|string  $event
     * @param  \NoResponse\Models\Shared\WebhookEndpointState|string  $state
     * @param  ?bool  $verified
     * @phpstan-pure
     */
    public function __construct(string $deliveryId, string $endpointId, WebhookTestRequestEvent|string $event, WebhookEndpointState|string $state, ?bool $verified = null)
    {
        $this->deliveryId = $deliveryId;
        $this->endpointId = $endpointId;
        $this->event = $event;
        $this->state = $state;
        $this->verified = $verified;
    }
}