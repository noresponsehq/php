<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Listed and returned members are active. */
enum MemberStatus: string
{
    case Active = 'active';
}
