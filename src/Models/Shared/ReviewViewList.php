<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ReviewViewList - List your private and shared review filters. */
class ReviewViewList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\ReviewView> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ReviewView>')]
    public array $items;

    /**
     * @param  array<\NoResponse\Models\Shared\ReviewView>  $items
     * @phpstan-pure
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}