<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** partial finished with some attendees not covered; attendees_failed counts them. */
enum ScreeningStatus: string
{
    case Queued = 'queued';
    case Running = 'running';
    case Completed = 'completed';
    case Partial = 'partial';
    case Failed = 'failed';
    case Cancelled = 'cancelled';
}
