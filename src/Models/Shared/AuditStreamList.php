<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AuditStreamList - Read audit stream subscriptions. */
class AuditStreamList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\AuditStream> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AuditStream>')]
    public array $items;

    /**
     * @param  array<\NoResponse\Models\Shared\AuditStream>  $items
     * @phpstan-pure
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}