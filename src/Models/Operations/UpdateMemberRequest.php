<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class UpdateMemberRequest
{
    /**
     * Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.
     *
     * @var string $workspaceId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=workspace_id')]
    public string $workspaceId;

    /**
     * The member's mem_ id. A member of another workspace, or a removed one, answers 404.
     *
     * @var string $memberId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=member_id')]
    public string $memberId;

    /**
     *
     * @var \NoResponse\Models\Shared\MemberUpdateRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\MemberUpdateRequest $body;

    /**
     * @param  string  $workspaceId
     * @param  string  $memberId
     * @param  \NoResponse\Models\Shared\MemberUpdateRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, string $memberId, Shared\MemberUpdateRequest $body)
    {
        $this->workspaceId = $workspaceId;
        $this->memberId = $memberId;
        $this->body = $body;
    }
}