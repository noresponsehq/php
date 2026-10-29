<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AuditEvent - One privileged workspace action with its actor, target, outcome and time. Successful data changes commit their audit evidence atomically. Sensitive exports record access before returning bytes. Details exclude secrets and subject identifiers. */
class AuditEvent
{
    /**
     * Opaque, server-assigned event id: aud_ and a 26-character ULID.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

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
     * What happened, as resource.verb: workspace.created, member.role_changed, member.removed, invite.created, invite.revoked, invite.accepted, key.rotated, webhook_endpoint.created, webhook_endpoint.deleted, webhook_endpoint.secret_rotated, integration.created, integration.deleted, integration.secret_rotated, list_entry.created, list_entry.deleted, webhook_endpoint.test_sent, webhook_endpoint.verification_requested, webhook_endpoint.delivery_replayed, assessment.created, assessment.outcome_recorded, assessment.deleted, account.outcome_recorded, account.enforcement_recorded, account.deleted, account.exported. A change with no finer name carries the permission it used, such as keys.live.write. New actions may appear; treat an unknown one as a change to its target.
     *
     * @var string $action
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('action')]
    public string $action;

    /**
     *
     * @var \NoResponse\Models\Shared\CustomerExportRequestFilterOutcome|string $outcome
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('outcome')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\CustomerExportRequestFilterOutcome|string')]
    public CustomerExportRequestFilterOutcome|string $outcome;

    /**
     *
     * @var \NoResponse\Models\Shared\UserActor|\NoResponse\Models\Shared\KeyActor $actor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('actor')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\UserActor|\NoResponse\Models\Shared\KeyActor')]
    public UserActor|KeyActor $actor;

    /**
     *
     * @var \NoResponse\Models\Shared\AuditEventTarget $target
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('target')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AuditEventTarget')]
    public AuditEventTarget $target;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * At most 8 short facts about the change, keyed by lowercase names: the role a member was given or accepted (role), the invite an accepted member used (invite_id), the key that replaced a rotated one (new_key_id), the assessment a member's change acted on (assessment_id). Absent when there are none.
     *
     * @var ?array<string, string> $detail
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('detail')]
    #[\NoResponse\Serializer\Annotation\Type('array<string, string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $detail = null;

    /**
     *
     * @var \NoResponse\Models\Shared\Environment|string|null $affectedEnvironment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('affected_environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Environment|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Environment|string|null $affectedEnvironment = null;

    /**
     * Validated request correlation id, also returned in X-Request-ID, linking this event to request diagnostics. Absent on historical events without correlation.
     *
     * @var ?string $requestId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('request_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $requestId = null;

    /**
     * @param  string  $id
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\AuditSettingsEnvironment|string  $environment
     * @param  string  $action
     * @param  \NoResponse\Models\Shared\CustomerExportRequestFilterOutcome|string  $outcome
     * @param  \NoResponse\Models\Shared\UserActor|\NoResponse\Models\Shared\KeyActor  $actor
     * @param  \NoResponse\Models\Shared\AuditEventTarget  $target
     * @param  string  $createdAt
     * @param  ?array<string, string>  $detail
     * @param  \NoResponse\Models\Shared\Environment|string|null  $affectedEnvironment
     * @param  ?string  $requestId
     * @phpstan-pure
     */
    public function __construct(string $id, string $workspaceId, AuditSettingsEnvironment|string $environment, string $action, CustomerExportRequestFilterOutcome|string $outcome, UserActor|KeyActor $actor, AuditEventTarget $target, string $createdAt, ?array $detail = null, Environment|string|null $affectedEnvironment = null, ?string $requestId = null)
    {
        $this->id = $id;
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
        $this->action = $action;
        $this->outcome = $outcome;
        $this->actor = $actor;
        $this->target = $target;
        $this->createdAt = $createdAt;
        $this->detail = $detail;
        $this->affectedEnvironment = $affectedEnvironment;
        $this->requestId = $requestId;
    }
}