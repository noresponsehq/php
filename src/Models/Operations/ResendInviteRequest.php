<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ResendInviteRequest
{
    /**
     * Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.
     *
     * @var string $workspaceId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=workspace_id')]
    public string $workspaceId;

    /**
     * The invite's inv_ id. An invite of another workspace, or one no longer pending, answers 404.
     *
     * @var string $inviteId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=invite_id')]
    public string $inviteId;

    /**
     *
     * @var \NoResponse\Models\Shared\InviteResendRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\InviteResendRequest $body;

    /**
     * @param  string  $workspaceId
     * @param  string  $inviteId
     * @param  \NoResponse\Models\Shared\InviteResendRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, string $inviteId, Shared\InviteResendRequest $body)
    {
        $this->workspaceId = $workspaceId;
        $this->inviteId = $inviteId;
        $this->body = $body;
    }
}