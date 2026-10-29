<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** CustomerExportList - List exports for one collection. */
class CustomerExportList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\CustomerExport> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\CustomerExport>')]
    public array $items;

    /**
     *
     * @var ?string $nextCursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_cursor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $nextCursor = null;

    /**
     * @param  array<\NoResponse\Models\Shared\CustomerExport>  $items
     * @param  ?string  $nextCursor
     * @phpstan-pure
     */
    public function __construct(array $items, ?string $nextCursor = null)
    {
        $this->items = $items;
        $this->nextCursor = $nextCursor;
    }
}