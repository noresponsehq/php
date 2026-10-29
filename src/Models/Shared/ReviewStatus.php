<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ReviewStatus: string
{
    case Open = 'open';
    case InProgress = 'in_progress';
    case Resolved = 'resolved';
}
