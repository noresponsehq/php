<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum PolicyEvaluationStatus: string
{
    case Queued = 'queued';
    case Running = 'running';
    case Completed = 'completed';
    case Failed = 'failed';
    case Cancelled = 'cancelled';
}
