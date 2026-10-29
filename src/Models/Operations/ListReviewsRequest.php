<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListReviewsRequest
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
     * @var ?string $cursor
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=cursor')]
    public ?string $cursor = null;

    /**
     *
     * @var \NoResponse\Models\Shared\ReviewStatus|string|null $status
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=status')]
    public Shared\ReviewStatus|string|null $status = null;

    /**
     *
     * @var \NoResponse\Models\Shared\Priority|string|null $priority
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=priority')]
    public Shared\Priority|string|null $priority = null;

    /**
     *
     * @var ?string $assignee
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=assignee')]
    public ?string $assignee = null;

    /**
     *
     * @var ?bool $unassigned
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=unassigned')]
    public ?bool $unassigned = null;

    /**
     * Filter by immutable member ID. Mutually exclusive with assignee and unassigned=true.
     *
     * @var ?string $assigneePrincipalId
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=assignee_principal_id')]
    public ?string $assigneePrincipalId = null;

    /**
     * Only reviews of this exact account in the authenticated workspace and environment. Applied before pagination and bound into the cursor.
     *
     * @var ?string $accountId
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=account_id')]
    public ?string $accountId = null;

    /**
     *
     * @var ?int $limit
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=limit')]
    public ?int $limit = null;

    /**
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\KeyEnvironment|string  $environment
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @param  \NoResponse\Models\Shared\ReviewStatus|string|null  $status
     * @param  \NoResponse\Models\Shared\Priority|string|null  $priority
     * @param  ?string  $assignee
     * @param  ?bool  $unassigned
     * @param  ?string  $assigneePrincipalId
     * @param  ?string  $accountId
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, Shared\KeyEnvironment|string $environment, ?string $cursor = null, Shared\ReviewStatus|string|null $status = null, Shared\Priority|string|null $priority = null, ?string $assignee = null, ?bool $unassigned = null, ?string $assigneePrincipalId = null, ?string $accountId = null, ?int $limit = 50)
    {
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
        $this->cursor = $cursor;
        $this->status = $status;
        $this->priority = $priority;
        $this->assignee = $assignee;
        $this->unassigned = $unassigned;
        $this->assigneePrincipalId = $assigneePrincipalId;
        $this->accountId = $accountId;
        $this->limit = $limit;
    }
}