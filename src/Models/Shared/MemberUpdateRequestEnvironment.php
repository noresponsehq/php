<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum MemberUpdateRequestEnvironment: string
{
    case Live = 'live';
    case Test = 'test';
}
