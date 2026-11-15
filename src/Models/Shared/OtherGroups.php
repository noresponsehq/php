<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** OtherGroups - Where else in the environment the person appears, read live from those groups: deleting one removes it here. */
class OtherGroups
{
    /**
     * How many other groups include this person, of which items lists the 20 most recent.
     *
     * @var int $total
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('total')]
    public int $total;

    /**
     * This person's memberships in the 20 most recent other groups, newest group first.
     *
     * @var array<\NoResponse\Models\Shared\OtherGroup> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\OtherGroup>')]
    public array $items;

    /**
     * @param  int  $total
     * @param  array<\NoResponse\Models\Shared\OtherGroup>  $items
     * @phpstan-pure
     */
    public function __construct(int $total, array $items)
    {
        $this->total = $total;
        $this->items = $items;
    }
}