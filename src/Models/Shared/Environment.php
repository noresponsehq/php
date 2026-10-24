<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The environment whose endpoints receive this event: live, or test for the workspace's test environment. */
enum Environment: string
{
    case Live = 'live';
    case Test = 'test';
}
