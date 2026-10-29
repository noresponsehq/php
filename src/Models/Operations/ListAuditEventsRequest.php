<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListAuditEventsRequest
{
    /**
     * Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.
     *
     * @var string $workspaceId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=workspace_id')]
    public string $workspaceId;

    /**
     * next_cursor from the previous page, unchanged; keep every filter unchanged.
     *
     * @var ?string $cursor
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=cursor')]
    public ?string $cursor = null;

    /**
     * Affected scope. API keys can request only their own environment. Omit to read the scopes the caller is allowed.
     *
     * @var \NoResponse\Models\Shared\Environment|string|null $environment
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=environment')]
    public Shared\Environment|string|null $environment = null;

    /**
     * Exact action, such as key.created or account.deleted.
     *
     * @var ?string $action
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=action')]
    public ?string $action = null;

    /**
     * Exact external user id, public API key id or console credential id.
     *
     * @var ?string $actor
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=actor')]
    public ?string $actor = null;

    /**
     * Exact target kind, such as key, member, setting or workspace.
     *
     * @var ?string $targetType
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=target_type')]
    public ?string $targetType = null;

    /**
     * Public target identifier. Audit targets exclude subject identifiers.
     *
     * @var ?string $targetId
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=target_id')]
    public ?string $targetId = null;

    /**
     * Exact outcome.
     *
     * @var \NoResponse\Models\Shared\CustomerExportRequestFilterOutcome|string|null $outcome
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=outcome')]
    public Shared\CustomerExportRequestFilterOutcome|string|null $outcome = null;

    /**
     * Inclusive creation timestamp in RFC3339 format.
     *
     * @var ?string $since
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=since')]
    public ?string $since = null;

    /**
     * Exclusive creation timestamp in RFC3339 format; must follow since when both are supplied.
     *
     * @var ?string $until
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=until')]
    public ?string $until = null;

    /**
     * Events per page.
     *
     * @var ?int $limit
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=limit')]
    public ?int $limit = null;

    /**
     * @param  string  $workspaceId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @param  \NoResponse\Models\Shared\Environment|string|null  $environment
     * @param  ?string  $action
     * @param  ?string  $actor
     * @param  ?string  $targetType
     * @param  ?string  $targetId
     * @param  \NoResponse\Models\Shared\CustomerExportRequestFilterOutcome|string|null  $outcome
     * @param  ?string  $since
     * @param  ?string  $until
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, ?string $cursor = null, Shared\Environment|string|null $environment = null, ?string $action = null, ?string $actor = null, ?string $targetType = null, ?string $targetId = null, Shared\CustomerExportRequestFilterOutcome|string|null $outcome = null, ?string $since = null, ?string $until = null, ?int $limit = 20)
    {
        $this->workspaceId = $workspaceId;
        $this->cursor = $cursor;
        $this->environment = $environment;
        $this->action = $action;
        $this->actor = $actor;
        $this->targetType = $targetType;
        $this->targetId = $targetId;
        $this->outcome = $outcome;
        $this->since = $since;
        $this->until = $until;
        $this->limit = $limit;
    }
}