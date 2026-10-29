<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum Environment: string
{
    case Live = 'live';
    case Test = 'test';
    case Workspace = 'workspace';
}
