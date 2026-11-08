<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CancelScreeningRequest
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
     * @var string $screeningId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=screening_id')]
    public string $screeningId;

    /**
     *
     * @var \NoResponse\Models\Shared\ScreeningCancelRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\ScreeningCancelRequest $body;

    /**
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\KeyEnvironment|string  $environment
     * @param  string  $eventId
     * @param  string  $screeningId
     * @param  \NoResponse\Models\Shared\ScreeningCancelRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, Shared\KeyEnvironment|string $environment, string $eventId, string $screeningId, Shared\ScreeningCancelRequest $body)
    {
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
        $this->eventId = $eventId;
        $this->screeningId = $screeningId;
        $this->body = $body;
    }
}