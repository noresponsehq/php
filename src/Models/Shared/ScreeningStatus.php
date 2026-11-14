<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** partial finished with some people or platforms not covered; people_failed and people_partial count them. */
enum ScreeningStatus: string
{
    case Queued = 'queued';
    case Running = 'running';
    case Completed = 'completed';
    case Partial = 'partial';
    case Failed = 'failed';
    case Cancelled = 'cancelled';
}
