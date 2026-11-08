<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class UpdateEventRequest
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
     * @var string $eventId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=event_id')]
    public string $eventId;

    /**
     *
     * @var \NoResponse\Models\Shared\EventUpdate $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\EventUpdate $body;

    /**
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\KeyEnvironment|string  $environment
     * @param  string  $eventId
     * @param  \NoResponse\Models\Shared\EventUpdate  $body
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, Shared\KeyEnvironment|string $environment, string $eventId, Shared\EventUpdate $body)
    {
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
        $this->eventId = $eventId;
        $this->body = $body;
    }
}