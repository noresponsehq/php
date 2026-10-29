<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Invite - A pending workspace invitation. Creating or reissuing it returns a token once; lists omit it. The token can be accepted once before expiry and is invalidated on revocation or reissue. Token state does not establish email delivery. */
class Invite
{
    /**
     * Opaque, server-assigned invite id: inv_ and a 26-character ULID.
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
     * A built-in capability set. Specialist roles are independent; effective access is returned by GET /v1/workspaces/{workspace_id}/capabilities.
     *
     * @var \NoResponse\Models\Shared\Role|string $role
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('role')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Role|string')]
    public Role|string $role;

    /**
     * The stable member id that issued this invite, or the authenticated live API key prefix for members_manage automation. Reissuing preserves the original creator; the audit event names the reissuing actor.
     *
     * @var string $createdBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_by')]
    public string $createdBy;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    public string $expiresAt;

    /**
     * Where the console sends the invite. Informational: it is not matched against the accepting user.
     *
     * @var ?string $email
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('email')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $email = null;

    /**
     * The user's id at the identity provider the console signs people in with: 1 to 256 printable ASCII characters with no space, compared exactly.
     *
     * @var ?string $externalUserId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('external_user_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $externalUserId = null;

    /**
     * The invite token: nrinv_, the invite id's ULID, _ and 43 unpadded base64url characters (32 random bytes). The new member's console sends it to POST /v1/invites/accept.
     *
     * @var ?string $token
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('token')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $token = null;

    /**
     * Allowed data environments. Invites default to both. Omitted on member PATCH preserves the current grants; owners retain both.
     *
     * @var array<\NoResponse\Models\Shared\InviteEnvironment|string>|null $environments
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environments')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\InviteEnvironment|string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $environments = null;

    /**
     * Independent removals from a built-in preset: sensitive evidence, exports, or active policy publication. Owners retain full authority. Omitted member updates preserve exclusions.
     *
     * @var array<\NoResponse\Models\Shared\InviteDeniedAction|string>|null $deniedActions
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('denied_actions')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\InviteDeniedAction|string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $deniedActions = null;

    /**
     * Last token reissue, not proof of email delivery.
     *
     * @var ?string $reissuedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reissued_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $reissuedAt = null;

    /**
     * @param  string  $id
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\Role|string  $role
     * @param  string  $createdBy
     * @param  string  $createdAt
     * @param  string  $expiresAt
     * @param  ?string  $email
     * @param  ?string  $externalUserId
     * @param  ?string  $token
     * @param  array<\NoResponse\Models\Shared\InviteEnvironment|string>|null  $environments
     * @param  array<\NoResponse\Models\Shared\InviteDeniedAction|string>|null  $deniedActions
     * @param  ?string  $reissuedAt
     * @phpstan-pure
     */
    public function __construct(string $id, string $workspaceId, Role|string $role, string $createdBy, string $createdAt, string $expiresAt, ?string $email = null, ?string $externalUserId = null, ?string $token = null, ?array $environments = null, ?array $deniedActions = null, ?string $reissuedAt = null)
    {
        $this->id = $id;
        $this->workspaceId = $workspaceId;
        $this->role = $role;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
        $this->expiresAt = $expiresAt;
        $this->email = $email;
        $this->externalUserId = $externalUserId;
        $this->token = $token;
        $this->environments = $environments;
        $this->deniedActions = $deniedActions;
        $this->reissuedAt = $reissuedAt;
    }
}