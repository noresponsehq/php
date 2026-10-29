<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum CustomerExportRequestKind: string
{
    case Account = 'account';
    case Audit = 'audit';
}
