<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PersonBatch - What the batch did, row by row. */
class PersonBatch
{
    /**
     *
     * @var int $created
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created')]
    public int $created;

    /**
     *
     * @var int $updated
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('updated')]
    public int $updated;

    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\PersonBatchItem> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\PersonBatchItem>')]
    public array $items;

    /**
     * @param  int  $created
     * @param  int  $updated
     * @param  array<\NoResponse\Models\Shared\PersonBatchItem>  $items
     * @phpstan-pure
     */
    public function __construct(int $created, int $updated, array $items)
    {
        $this->created = $created;
        $this->updated = $updated;
        $this->items = $items;
    }
}