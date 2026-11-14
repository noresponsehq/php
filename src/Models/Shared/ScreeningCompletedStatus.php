<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** completed reached every person; partial left some not fully covered (partial_coverage); failed covered nobody. */
enum ScreeningCompletedStatus: string
{
    case Completed = 'completed';
    case Partial = 'partial';
    case Failed = 'failed';
}
