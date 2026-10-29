<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ErasureReceiptTargetStatus: string
{
    case Pending = 'pending';
    case Completed = 'completed';
}
