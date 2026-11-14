<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PersonList - People in upload order. */
class PersonList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\Person> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Person>')]
    public array $items;

    /**
     * Pass as after to read the next page.
     *
     * @var ?string $nextAfter
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_after')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $nextAfter = null;

    /**
     * @param  array<\NoResponse\Models\Shared\Person>  $items
     * @param  ?string  $nextAfter
     * @phpstan-pure
     */
    public function __construct(array $items, ?string $nextAfter = null)
    {
        $this->items = $items;
        $this->nextAfter = $nextAfter;
    }
}