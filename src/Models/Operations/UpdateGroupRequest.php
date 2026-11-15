<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class UpdateGroupRequest
{
    /**
     *
     * @var string $groupId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=group_id')]
    public string $groupId;

    /**
     *
     * @var \NoResponse\Models\Shared\GroupUpdate $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\GroupUpdate $body;

    /**
     * @param  string  $groupId
     * @param  \NoResponse\Models\Shared\GroupUpdate  $body
     * @phpstan-pure
     */
    public function __construct(string $groupId, Shared\GroupUpdate $body)
    {
        $this->groupId = $groupId;
        $this->body = $body;
    }
}