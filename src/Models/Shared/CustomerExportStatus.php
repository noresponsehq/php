<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum CustomerExportStatus: string
{
    case Queued = 'queued';
    case Running = 'running';
    case Completed = 'completed';
    case Failed = 'failed';
    case Cancelled = 'cancelled';
    case Expired = 'expired';
}
