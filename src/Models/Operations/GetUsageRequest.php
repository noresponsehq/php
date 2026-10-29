<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class GetUsageRequest
{
    /**
     * Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.
     *
     * @var string $workspaceId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=workspace_id')]
    public string $workspaceId;

    /**
     * The first UTC day, as YYYY-MM-DD.
     *
     * @var ?string $from
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=from')]
    public ?string $from = null;

    /**
     * The last UTC day, included, as YYYY-MM-DD; no later than today.
     *
     * @var ?string $to
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=to')]
    public ?string $to = null;

    /**
     * @param  string  $workspaceId
     * @param  ?string  $from
     * @param  ?string  $to
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, ?string $from = null, ?string $to = null)
    {
        $this->workspaceId = $workspaceId;
        $this->from = $from;
        $this->to = $to;
    }
}