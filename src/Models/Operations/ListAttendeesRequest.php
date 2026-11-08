<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListAttendeesRequest
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
     * Read attendees after this one.
     *
     * @var ?string $after
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=after')]
    public ?string $after = null;

    /**
     * Only attendees whose highest finding has this band; none for attendees with no finding.
     *
     * @var ?\NoResponse\Models\Shared\ListAttendeesBand $band
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=band')]
    public ?Shared\ListAttendeesBand $band = null;

    /**
     * Only attendees with this decision; undecided for none yet.
     *
     * @var ?\NoResponse\Models\Shared\ListAttendeesDecision $decision
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=decision')]
    public ?Shared\ListAttendeesDecision $decision = null;

    /**
     * At most this many attendees.
     *
     * @var ?int $limit
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=limit')]
    public ?int $limit = null;

    /**
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\KeyEnvironment|string  $environment
     * @param  string  $eventId
     * @param  ?int  $limit
     * @param  ?string  $after
     * @param  ?\NoResponse\Models\Shared\ListAttendeesBand  $band
     * @param  ?\NoResponse\Models\Shared\ListAttendeesDecision  $decision
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, Shared\KeyEnvironment|string $environment, string $eventId, ?string $after = null, ?Shared\ListAttendeesBand $band = null, ?Shared\ListAttendeesDecision $decision = null, ?int $limit = 100)
    {
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
        $this->eventId = $eventId;
        $this->after = $after;
        $this->band = $band;
        $this->decision = $decision;
        $this->limit = $limit;
    }
}