<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ListImpactTransition
{
    /**
     *
     * @var \NoResponse\Models\Shared\ListImpactTransitionFrom|string $from
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('from')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ListImpactTransitionFrom|string')]
    public ListImpactTransitionFrom|string $from;

    /**
     *
     * @var \NoResponse\Models\Shared\ListImpactTransitionFrom|string $to
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('to')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ListImpactTransitionFrom|string')]
    public ListImpactTransitionFrom|string $to;

    /**
     *
     * @var int $count
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('count')]
    public int $count;

    /**
     * @param  \NoResponse\Models\Shared\ListImpactTransitionFrom|string  $from
     * @param  \NoResponse\Models\Shared\ListImpactTransitionFrom|string  $to
     * @param  int  $count
     * @phpstan-pure
     */
    public function __construct(ListImpactTransitionFrom|string $from, ListImpactTransitionFrom|string $to, int $count)
    {
        $this->from = $from;
        $this->to = $to;
        $this->count = $count;
    }
}