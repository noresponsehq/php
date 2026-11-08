<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** EventList - Events, newest first. */
class EventList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\Event> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Event>')]
    public array $items;

    /**
     * Pass as before to read the next, older page.
     *
     * @var ?string $nextBefore
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_before')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $nextBefore = null;

    /**
     * @param  array<\NoResponse\Models\Shared\Event>  $items
     * @param  ?string  $nextBefore
     * @phpstan-pure
     */
    public function __construct(array $items, ?string $nextBefore = null)
    {
        $this->items = $items;
        $this->nextBefore = $nextBefore;
    }
}