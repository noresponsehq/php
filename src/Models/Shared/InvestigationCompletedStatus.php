<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum InvestigationCompletedStatus: string
{
    case Completed = 'completed';
    case Partial = 'partial';
    case Failed = 'failed';
    case Cancelled = 'cancelled';
}
