<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ListEntryList - GET /v1/workspaces/{workspace_id}/lists/{environment}: every entry of the environment's list, newest first. An environment holds at most 10,000 entries. */
class ListEntryList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\ListEntry> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ListEntry>')]
    public array $items;

    /**
     * @param  array<\NoResponse\Models\Shared\ListEntry>  $items
     * @phpstan-pure
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}