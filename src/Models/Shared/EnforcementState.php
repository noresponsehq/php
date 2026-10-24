<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The account's state in the workspace's identity provider just before the action: onboarding, provisional (created, not yet activated), active, restricted or rejected. */
enum EnforcementState: string
{
    case Onboarding = 'onboarding';
    case Provisional = 'provisional';
    case Active = 'active';
    case Restricted = 'restricted';
    case Rejected = 'rejected';
}
