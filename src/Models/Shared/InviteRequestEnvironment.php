<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum InviteRequestEnvironment: string
{
    case Live = 'live';
    case Test = 'test';
}
