<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** InviteRequest - POST /v1/workspaces/{workspace_id}/invites body. Creates an invite for role and returns its token once. email is where the console sends the token and is not checked against the user who accepts. With external_user_id set, only that user can accept. */
class InviteRequest
{
    /**
     * A built-in capability set. Specialist roles are independent; effective access is returned by GET /v1/workspaces/{workspace_id}/capabilities.
     *
     * @var \NoResponse\Models\Shared\Role|string $role
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('role')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Role|string')]
    public Role|string $role;

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
     * Allowed data environments. Invites default to both. Omitted on member PATCH preserves the current grants; owners retain both.
     *
     * @var ?array<\NoResponse\Models\Shared\InviteRequestEnvironment> $environments
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environments')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\InviteRequestEnvironment>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $environments = null;

    /**
     * Independent removals from a built-in preset: sensitive evidence, exports, or active policy publication. Owners retain full authority. Omitted member updates preserve exclusions.
     *
     * @var ?array<\NoResponse\Models\Shared\InviteRequestDeniedAction> $deniedActions
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('denied_actions')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\InviteRequestDeniedAction>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $deniedActions = null;

    /**
     * @param  \NoResponse\Models\Shared\Role|string  $role
     * @param  ?string  $email
     * @param  ?string  $externalUserId
     * @param  ?array<\NoResponse\Models\Shared\InviteRequestEnvironment>  $environments
     * @param  ?array<\NoResponse\Models\Shared\InviteRequestDeniedAction>  $deniedActions
     * @phpstan-pure
     */
    public function __construct(Role|string $role, ?string $email = null, ?string $externalUserId = null, ?array $environments = null, ?array $deniedActions = null)
    {
        $this->role = $role;
        $this->email = $email;
        $this->externalUserId = $externalUserId;
        $this->environments = $environments;
        $this->deniedActions = $deniedActions;
    }
}