<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class RunSearchRequest
{
    /**
     * Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.
     *
     * @var string $workspaceId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=workspace_id')]
    public string $workspaceId;

    /**
     * The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404.
     *
     * @var \NoResponse\Models\Shared\KeyEnvironment|string $environment
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=environment')]
    public Shared\KeyEnvironment|string $environment;

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
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\KeyEnvironment|string  $environment
     * @param  string  $groupId
     * @param  string  $personId
     * @param  string  $searchId
     * @param  \NoResponse\Models\Shared\ScreeningCancelRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, Shared\KeyEnvironment|string $environment, string $groupId, string $personId, string $searchId, Shared\ScreeningCancelRequest $body)
    {
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
        $this->groupId = $groupId;
        $this->personId = $personId;
        $this->searchId = $searchId;
        $this->body = $body;
    }
}