<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class UpdateAuditRetentionRequest
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
     * @var \NoResponse\Models\Operations\Environment $environment
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=environment')]
    public Environment $environment;

    /**
     *
     * @var \NoResponse\Models\Shared\AuditSettingsRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\AuditSettingsRequest $body;

    /**
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Operations\Environment  $environment
     * @param  \NoResponse\Models\Shared\AuditSettingsRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, Environment $environment, Shared\AuditSettingsRequest $body)
    {
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
        $this->body = $body;
    }
}