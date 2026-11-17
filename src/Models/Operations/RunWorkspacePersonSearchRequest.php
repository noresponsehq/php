<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class RunWorkspacePersonSearchRequest
{
    /**
     *
     * @var string $personId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=person_id')]
    public string $personId;

    /**
     *
     * @var string $searchId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=search_id')]
    public string $searchId;

    /**
     *
     * @var \NoResponse\Models\Shared\ScreeningCancelRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\ScreeningCancelRequest $body;

    /**
     * @param  string  $personId
     * @param  string  $searchId
     * @param  \NoResponse\Models\Shared\ScreeningCancelRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $personId, string $searchId, Shared\ScreeningCancelRequest $body)
    {
        $this->personId = $personId;
        $this->searchId = $searchId;
        $this->body = $body;
    }
}