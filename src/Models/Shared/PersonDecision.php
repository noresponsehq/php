<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum PersonDecision: string
{
    case Cleared = 'cleared';
    case Watch = 'watch';
    case Escalated = 'escalated';
}
