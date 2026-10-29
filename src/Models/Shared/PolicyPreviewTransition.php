<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PolicyPreviewTransition
{
    /**
     *
     * @var \NoResponse\Models\Shared\FromT|string $from
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('from')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FromT|string')]
    public FromT|string $from;

    /**
     *
     * @var \NoResponse\Models\Shared\FromT|string $to
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('to')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FromT|string')]
    public FromT|string $to;

    /**
     *
     * @var int $count
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('count')]
    public int $count;

    /**
     * @param  \NoResponse\Models\Shared\FromT|string  $from
     * @param  \NoResponse\Models\Shared\FromT|string  $to
     * @param  int  $count
     * @phpstan-pure
     */
    public function __construct(FromT|string $from, FromT|string $to, int $count)
    {
        $this->from = $from;
        $this->to = $to;
        $this->count = $count;
    }
}