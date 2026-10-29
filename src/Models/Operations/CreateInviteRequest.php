<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CreateInviteRequest
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
     * @var \NoResponse\Models\Shared\InviteRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\InviteRequest $body;

    /**
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\InviteRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, Shared\InviteRequest $body)
    {
        $this->workspaceId = $workspaceId;
        $this->body = $body;
    }
}