<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WebhookEndpointList - GET /v1/webhooks answer: every endpoint of the calling workspace, in every state, ordered by endpoint_id. A workspace holds at most 5, so there is no page. */
class WebhookEndpointList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\WebhookEndpoint> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\WebhookEndpoint>')]
    public array $items;

    /**
     * @param  array<\NoResponse\Models\Shared\WebhookEndpoint>  $items
     * @phpstan-pure
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}