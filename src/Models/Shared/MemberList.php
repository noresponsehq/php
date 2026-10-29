<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** MemberList - GET /v1/workspaces/{workspace_id}/members: the workspace's active members, oldest first, at most 100. */
class MemberList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\Member> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Member>')]
    public array $items;

    /**
     * @param  array<\NoResponse\Models\Shared\Member>  $items
     * @phpstan-pure
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}