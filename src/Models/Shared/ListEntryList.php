<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ListEntryList - Newest first. Without a query, returns every active entry for compatibility. With limit or cursor, returns up to 100 entries and an authenticated workspace/environment-bound cursor. Expired entries are omitted. */
class ListEntryList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\ListEntry> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ListEntry>')]
    public array $items;

    /**
     *
     * @var ?string $nextCursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_cursor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $nextCursor = null;

    /**
     * @param  array<\NoResponse\Models\Shared\ListEntry>  $items
     * @param  ?string  $nextCursor
     * @phpstan-pure
     */
    public function __construct(array $items, ?string $nextCursor = null)
    {
        $this->items = $items;
        $this->nextCursor = $nextCursor;
    }
}