<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ListAttendeesDecision: string
{
    case Cleared = 'cleared';
    case Watch = 'watch';
    case Escalated = 'escalated';
    case Undecided = 'undecided';
}
