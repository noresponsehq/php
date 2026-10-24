<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WebhookEndpointDisabledEvent - The webhook_endpoint.disabled event. */
class WebhookEndpointDisabledEvent
{
    /**
     * The event id, equal to the NR-Webhook-Id header and across redeliveries and every endpoint the event fans out to.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * When the event was created. Equal across redeliveries; the signing timestamp header is per delivery.
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * One of the environment's endpoints stopped receiving events: every delivery attempt to it failed from failing_since until disabled_at, 72 hours or more. Its queued deliveries are dropped. Fix the receiver and verify it again with POST /v1/webhooks/{endpoint_id}/test (type endpoint.verification) to resume delivery.
     *
     * @var \NoResponse\Models\Shared\WebhookEndpointDisabled $data
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('data')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\WebhookEndpointDisabled')]
    public WebhookEndpointDisabled $data;

    /**
     * Present, and true, only on an event sent by POST /v1/webhooks/{endpoint_id}/test: its data is a fixed example assessment, not one of the workspace's, so a receiver acknowledges it and applies nothing. Real events have no test member.
     *
     * @var ?bool $test
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('test')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $test = null;

    /**
     * Always webhook_endpoint.disabled.
     *
     * @var string $type
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('type')]
    public string $type;

    /**
     * @param  string  $id
     * @param  string  $createdAt
     * @param  string  $type
     * @param  \NoResponse\Models\Shared\WebhookEndpointDisabled  $data
     * @param  ?bool  $test
     * @phpstan-pure
     */
    public function __construct(string $id, string $createdAt, WebhookEndpointDisabled $data, ?bool $test = null, string $type = 'webhook_endpoint.disabled')
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->data = $data;
        $this->test = $test;
        $this->type = $type;
    }
}