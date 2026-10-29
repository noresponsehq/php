<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum AuditSettingsEnvironment: string
{
    case Live = 'live';
    case Test = 'test';
}
