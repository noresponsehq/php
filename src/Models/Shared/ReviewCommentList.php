<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ReviewCommentList - Read retained review comments. */
class ReviewCommentList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\ReviewComment> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ReviewComment>')]
    public array $items;

    /**
     *
     * @var ?string $nextCursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_cursor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $nextCursor = null;

    /**
     * @param  array<\NoResponse\Models\Shared\ReviewComment>  $items
     * @param  ?string  $nextCursor
     * @phpstan-pure
     */
    public function __construct(array $items, ?string $nextCursor = null)
    {
        $this->items = $items;
        $this->nextCursor = $nextCursor;
    }
}