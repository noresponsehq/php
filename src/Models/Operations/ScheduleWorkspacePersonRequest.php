<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ScheduleWorkspacePersonRequest
{
    /**
     *
     * @var string $personId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=person_id')]
    public string $personId;

    /**
     *
     * @var \NoResponse\Models\Shared\PersonScheduleRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\PersonScheduleRequest $body;

    /**
     * @param  string  $personId
     * @param  \NoResponse\Models\Shared\PersonScheduleRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $personId, Shared\PersonScheduleRequest $body)
    {
        $this->personId = $personId;
        $this->body = $body;
    }
}