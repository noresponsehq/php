<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** OtherEvents - Where else in the environment the attendee appears, read live from those events: deleting one removes it here. */
class OtherEvents
{
    /**
     * How many attendees of other events match, of which items lists the 20 most recent.
     *
     * @var int $total
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('total')]
    public int $total;

    /**
     * The 20 attendees of the most recent other events, newest event first.
     *
     * @var array<\NoResponse\Models\Shared\OtherEvent> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\OtherEvent>')]
    public array $items;

    /**
     * @param  int  $total
     * @param  array<\NoResponse\Models\Shared\OtherEvent>  $items
     * @phpstan-pure
     */
    public function __construct(int $total, array $items)
    {
        $this->total = $total;
        $this->items = $items;
    }
}