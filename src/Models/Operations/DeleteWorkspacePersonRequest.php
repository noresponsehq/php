<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class DeleteWorkspacePersonRequest
{
    /**
     *
     * @var string $personId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=person_id')]
    public string $personId;

    /**
     * @param  string  $personId
     * @phpstan-pure
     */
    public function __construct(string $personId)
    {
        $this->personId = $personId;
    }
}