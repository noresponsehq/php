<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ReviewWorkspacePersonChangeRequest
{
    /**
     *
     * @var string $personId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=person_id')]
    public string $personId;

    /**
     *
     * @var string $changeId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=change_id')]
    public string $changeId;

    /**
     *
     * @var \NoResponse\Models\Shared\ScreeningCancelRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\ScreeningCancelRequest $body;

    /**
     * @param  string  $personId
     * @param  string  $changeId
     * @param  \NoResponse\Models\Shared\ScreeningCancelRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $personId, string $changeId, Shared\ScreeningCancelRequest $body)
    {
        $this->personId = $personId;
        $this->changeId = $changeId;
        $this->body = $body;
    }
}