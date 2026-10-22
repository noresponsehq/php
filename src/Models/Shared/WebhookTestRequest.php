<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WebhookTestRequest - POST /v1/webhooks/{endpoint_id}/test body: which event to send. */
class WebhookTestRequest
{
    /**
     * endpoint.verification sends a fresh challenge now, in this call, and the endpoint is verified if it echoes it. assessment.updated queues an event whose data is a fixed example assessment, with test true, delivered and retried like any other; the endpoint must be verified.
     *
     * @var \NoResponse\Models\Shared\WebhookTestRequestEvent $event
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('event')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\WebhookTestRequestEvent')]
    public WebhookTestRequestEvent $event;

    /**
     * @param  \NoResponse\Models\Shared\WebhookTestRequestEvent  $event
     * @phpstan-pure
     */
    public function __construct(WebhookTestRequestEvent $event)
    {
        $this->event = $event;
    }
}