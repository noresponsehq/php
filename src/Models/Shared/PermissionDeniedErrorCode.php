<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Machine codes an HTTP 403 answer can carry. */
enum PermissionDeniedErrorCode: string
{
    case WorkspaceForbidden = 'workspace_forbidden';
}
