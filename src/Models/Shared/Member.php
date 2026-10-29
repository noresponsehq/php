<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Member - One member of a workspace: an external user id holding one role. A removed member loses every permission at once. */
class Member
{
    /**
     * Opaque, server-assigned member id: mem_ and a 26-character ULID. It stays the same when a removed member is invited back.
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
     * The user's id at the identity provider the console signs people in with: 1 to 256 printable ASCII characters with no space, compared exactly.
     *
     * @var string $externalUserId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('external_user_id')]
    public string $externalUserId;

    /**
     * A built-in capability set. Specialist roles are independent; effective access is returned by GET /v1/workspaces/{workspace_id}/capabilities.
     *
     * @var \NoResponse\Models\Shared\Role|string $role
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('role')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Role|string')]
    public Role|string $role;

    /**
     * Listed and returned members are active.
     *
     * @var \NoResponse\Models\Shared\MemberStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\MemberStatus|string')]
    public MemberStatus|string $status;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var string $updatedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('updated_at')]
    public string $updatedAt;

    /**
     * Allowed data environments. Invites default to both. Omitted on member PATCH preserves the current grants; owners retain both.
     *
     * @var array<\NoResponse\Models\Shared\MemberEnvironment|string>|null $environments
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environments')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\MemberEnvironment|string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $environments = null;

    /**
     * Independent removals from a built-in preset: sensitive evidence, exports, or active policy publication. Owners retain full authority. Omitted member updates preserve exclusions.
     *
     * @var array<\NoResponse\Models\Shared\MemberDeniedAction|string>|null $deniedActions
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('denied_actions')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\MemberDeniedAction|string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $deniedActions = null;

    /**
     * Immutable internal workspace principal, equal to member id, preserved across explicit provider-identity migrations.
     *
     * @var ?string $principalId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('principal_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $principalId = null;

    /**
     * Informational display name. Authentication and provider identity use the verified subject binding.
     *
     * @var ?string $displayName
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('display_name')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $displayName = null;

    /**
     * Unverified contact address for display. Empty clears it; a supplied value must be an address. Identity linking uses the verified provider subject.
     *
     * @var ?string $unverifiedEmail
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('unverified_email')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $unverifiedEmail = null;

    /**
     * @param  string  $id
     * @param  string  $workspaceId
     * @param  string  $externalUserId
     * @param  \NoResponse\Models\Shared\Role|string  $role
     * @param  \NoResponse\Models\Shared\MemberStatus|string  $status
     * @param  string  $createdAt
     * @param  string  $updatedAt
     * @param  array<\NoResponse\Models\Shared\MemberEnvironment|string>|null  $environments
     * @param  array<\NoResponse\Models\Shared\MemberDeniedAction|string>|null  $deniedActions
     * @param  ?string  $principalId
     * @param  ?string  $displayName
     * @param  ?string  $unverifiedEmail
     * @phpstan-pure
     */
    public function __construct(string $id, string $workspaceId, string $externalUserId, Role|string $role, MemberStatus|string $status, string $createdAt, string $updatedAt, ?array $environments = null, ?array $deniedActions = null, ?string $principalId = null, ?string $displayName = null, ?string $unverifiedEmail = null)
    {
        $this->id = $id;
        $this->workspaceId = $workspaceId;
        $this->externalUserId = $externalUserId;
        $this->role = $role;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->environments = $environments;
        $this->deniedActions = $deniedActions;
        $this->principalId = $principalId;
        $this->displayName = $displayName;
        $this->unverifiedEmail = $unverifiedEmail;
    }
}