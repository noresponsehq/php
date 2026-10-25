<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** KeyList - GET /v1/workspaces/{workspace_id}/keys: the keys of both of the workspace's environments, newest first, at most 200 of each, revoked and expired keys included. No item carries a secret. */
class KeyList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\Key> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Key>')]
    public array $items;

    /**
     * @param  array<\NoResponse\Models\Shared\Key>  $items
     * @phpstan-pure
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}