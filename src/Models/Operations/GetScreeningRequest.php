<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class GetScreeningRequest
{
    /**
     *
     * @var string $groupId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=group_id')]
    public string $groupId;

    /**
     *
     * @var string $screeningId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=screening_id')]
    public string $screeningId;

    /**
     * @param  string  $groupId
     * @param  string  $screeningId
     * @phpstan-pure
     */
    public function __construct(string $groupId, string $screeningId)
    {
        $this->groupId = $groupId;
        $this->screeningId = $screeningId;
    }
}