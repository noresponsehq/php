<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class GetGroupRequest
{
    /**
     *
     * @var string $groupId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=group_id')]
    public string $groupId;

    /**
     * @param  string  $groupId
     * @phpstan-pure
     */
    public function __construct(string $groupId)
    {
        $this->groupId = $groupId;
    }
}