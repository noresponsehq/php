<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ReviewResolutionList - Read immutable review resolution history. */
class ReviewResolutionList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\Resolution> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Resolution>')]
    public array $items;

    /**
     *
     * @var ?int $nextBeforeVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_before_version')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $nextBeforeVersion = null;

    /**
     * @param  array<\NoResponse\Models\Shared\Resolution>  $items
     * @param  ?int  $nextBeforeVersion
     * @phpstan-pure
     */
    public function __construct(array $items, ?int $nextBeforeVersion = null)
    {
        $this->items = $items;
        $this->nextBeforeVersion = $nextBeforeVersion;
    }
}