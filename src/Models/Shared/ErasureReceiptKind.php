<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ErasureReceiptKind: string
{
    case Assessment = 'assessment';
    case Account = 'account';
    case Workspace = 'workspace';
}
