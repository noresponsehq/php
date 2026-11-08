<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum AttendeeDecision: string
{
    case Cleared = 'cleared';
    case Watch = 'watch';
    case Escalated = 'escalated';
}
