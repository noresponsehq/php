<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** GroupList - Groups, newest first. */
class GroupList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\Group> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Group>')]
    public array $items;

    /**
     * Pass as before to read the next, older page.
     *
     * @var ?string $nextBefore
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_before')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $nextBefore = null;

    /**
     * @param  array<\NoResponse\Models\Shared\Group>  $items
     * @param  ?string  $nextBefore
     * @phpstan-pure
     */
    public function __construct(array $items, ?string $nextBefore = null)
    {
        $this->items = $items;
        $this->nextBefore = $nextBefore;
    }
}