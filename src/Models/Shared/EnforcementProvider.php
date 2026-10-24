<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The identity provider the action ran in; custom for the workspace's own user store. */
enum EnforcementProvider: string
{
    case Clerk = 'clerk';
    case Workos = 'workos';
    case Auth0 = 'auth0';
    case Custom = 'custom';
}
