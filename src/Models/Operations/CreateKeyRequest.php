<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CreateKeyRequest
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
     * @var \NoResponse\Models\Shared\KeyRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\KeyRequest $body;

    /**
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\KeyRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, Shared\KeyRequest $body)
    {
        $this->workspaceId = $workspaceId;
        $this->body = $body;
    }
}