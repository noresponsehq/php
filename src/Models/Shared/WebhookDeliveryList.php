<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WebhookDeliveryList - The 200 answer of GET /v1/webhooks/{endpoint_id}/deliveries: one page of the endpoint's delivery attempts, newest first. Each item is one POST to the endpoint. Attempts are kept for 30 days, or the tenant's retention_days when that is shorter, and are deleted with the assessment they carried. next_cursor is present only when another page exists. */
class WebhookDeliveryList
{
    /**
     * Opaque id of the endpoint registration.
     *
     * @var string $endpointId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('endpoint_id')]
    public string $endpointId;

    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\WebhookDeliveryAttempt> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\WebhookDeliveryAttempt>')]
    public array $items;

    /**
     * Opaque cursor for the next page, MAC'd by the server and bound to the tenant and endpoint it was issued for. Pass it back unchanged as cursor; a tampered, foreign or expired cursor answers 400 invalid_cursor.
     *
     * @var ?string $nextCursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_cursor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $nextCursor = null;

    /**
     * @param  string  $endpointId
     * @param  array<\NoResponse\Models\Shared\WebhookDeliveryAttempt>  $items
     * @param  ?string  $nextCursor
     * @phpstan-pure
     */
    public function __construct(string $endpointId, array $items, ?string $nextCursor = null)
    {
        $this->endpointId = $endpointId;
        $this->items = $items;
        $this->nextCursor = $nextCursor;
    }
}