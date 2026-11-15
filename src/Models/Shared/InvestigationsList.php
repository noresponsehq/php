<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** InvestigationsList - List investigation history. */
class InvestigationsList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\Investigation> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Investigation>')]
    public array $items;

    /**
     *
     * @var bool $hasMore
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('has_more')]
    public bool $hasMore;

    /**
     *
     * @var ?string $nextCursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_cursor')]
    public ?string $nextCursor;

    /**
     * @param  array<\NoResponse\Models\Shared\Investigation>  $items
     * @param  bool  $hasMore
     * @param  ?string  $nextCursor
     * @phpstan-pure
     */
    public function __construct(array $items, bool $hasMore, ?string $nextCursor = null)
    {
        $this->items = $items;
        $this->hasMore = $hasMore;
        $this->nextCursor = $nextCursor;
    }
}