<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** MemberUpdateRequest - PATCH /v1/workspaces/{workspace_id}/members/{member_id} body: the member's new role. The workspace's last owner cannot be demoted. */
class MemberUpdateRequest
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
     * Allowed data environments. Invites default to both. Omitted on member PATCH preserves the current grants; owners retain both.
     *
     * @var ?array<\NoResponse\Models\Shared\MemberUpdateRequestEnvironment> $environments
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environments')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\MemberUpdateRequestEnvironment>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $environments = null;

    /**
     * Independent removals from a built-in preset: sensitive evidence, exports, or active policy publication. Owners retain full authority. Omitted member updates preserve exclusions.
     *
     * @var ?array<\NoResponse\Models\Shared\MemberUpdateRequestDeniedAction> $deniedActions
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('denied_actions')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\MemberUpdateRequestDeniedAction>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $deniedActions = null;

    /**
     * @param  \NoResponse\Models\Shared\Role|string  $role
     * @param  ?array<\NoResponse\Models\Shared\MemberUpdateRequestEnvironment>  $environments
     * @param  ?array<\NoResponse\Models\Shared\MemberUpdateRequestDeniedAction>  $deniedActions
     * @phpstan-pure
     */
    public function __construct(Role|string $role, ?array $environments = null, ?array $deniedActions = null)
    {
        $this->role = $role;
        $this->environments = $environments;
        $this->deniedActions = $deniedActions;
    }
}