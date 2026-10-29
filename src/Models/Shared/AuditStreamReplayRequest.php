<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class AuditStreamReplayRequest
{
    /**
     * Opaque, workspace-scoped webhook event id. A redelivery of the same event carries the same event_id, so consumers deduplicate on it.
     *
     * @var string $eventId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('event_id')]
    public string $eventId;

    /**
     * @param  string  $eventId
     * @phpstan-pure
     */
    public function __construct(string $eventId)
    {
        $this->eventId = $eventId;
    }
}