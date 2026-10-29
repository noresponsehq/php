<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum CustomerExportRequestFilterOutcome: string
{
    case Succeeded = 'succeeded';
    case Denied = 'denied';
}
