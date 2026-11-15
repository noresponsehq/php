<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class GetPersonRequest
{
    /**
     *
     * @var string $groupId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=group_id')]
    public string $groupId;

    /**
     *
     * @var string $personId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=person_id')]
    public string $personId;

    /**
     * @param  string  $groupId
     * @param  string  $personId
     * @phpstan-pure
     */
    public function __construct(string $groupId, string $personId)
    {
        $this->groupId = $groupId;
        $this->personId = $personId;
    }
}