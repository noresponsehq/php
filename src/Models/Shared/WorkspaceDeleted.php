<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WorkspaceDeleted - Terminal for the receiving endpoint's environment: its workspace was deleted. Every key of the environment already answers 401, its assessments and accounts are gone, and no further event follows. The workspace id is not reused, so a later event naming it cannot arrive. */
class WorkspaceDeleted
{
    /**
     * The workspace id, which is also its live environment's workspace id; the test environment's is the same id with :test appended. A workspace created through the API is tnt_ and a 26-character ULID.
     *
     * @var string $workspaceId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('workspace_id')]
    public string $workspaceId;

    /**
     *
     * @var \NoResponse\Models\Shared\AuditSettingsEnvironment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AuditSettingsEnvironment|string')]
    public AuditSettingsEnvironment|string $environment;

    /**
     * When the deletion took effect, equal to deleted_at in the DELETE answer.
     *
     * @var string $deletedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('deleted_at')]
    public string $deletedAt;

    /**
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\AuditSettingsEnvironment|string  $environment
     * @param  string  $deletedAt
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, AuditSettingsEnvironment|string $environment, string $deletedAt)
    {
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
        $this->deletedAt = $deletedAt;
    }
}