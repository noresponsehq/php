<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ErasureReceiptTargetName: string
{
    case Serving = 'serving';
    case Outbox = 'outbox';
}
