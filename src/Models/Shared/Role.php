<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** A built-in capability set. Specialist roles are independent; effective access is returned by GET /v1/workspaces/{workspace_id}/capabilities. */
enum Role: string
{
    case Owner = 'owner';
    case Admin = 'admin';
    case Developer = 'developer';
    case Viewer = 'viewer';
    case Investigator = 'investigator';
    case Auditor = 'auditor';
    case Billing = 'billing';
}
