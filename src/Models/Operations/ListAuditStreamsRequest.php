<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListAuditStreamsRequest
{
    /**
     * Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.
     *
     * @var string $workspaceId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=workspace_id')]
    public string $workspaceId;

    /**
     *
     * @var \NoResponse\Models\Shared\Environment|string $environment
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=environment')]
    public Shared\Environment|string $environment;

    /**
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\Environment|string  $environment
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, Shared\Environment|string $environment)
    {
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
    }
}