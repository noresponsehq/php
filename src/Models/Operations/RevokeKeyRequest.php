<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class RevokeKeyRequest
{
    /**
     * Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.
     *
     * @var string $workspaceId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=workspace_id')]
    public string $workspaceId;

    /**
     * The key's id. A key of another workspace answers 404, as does a key of the other environment to an API key.
     *
     * @var string $keyId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=key_id')]
    public string $keyId;

    /**
     * @param  string  $workspaceId
     * @param  string  $keyId
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, string $keyId)
    {
        $this->workspaceId = $workspaceId;
        $this->keyId = $keyId;
    }
}