<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** InviteList - GET /v1/workspaces/{workspace_id}/invites: the workspace's pending invites, oldest first, at most 50, with no token. */
class InviteList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\Invite> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Invite>')]
    public array $items;

    /**
     * @param  array<\NoResponse\Models\Shared\Invite>  $items
     * @phpstan-pure
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}