<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum RiskDetailsEventKind: string
{
    case Created = 'created';
    case LastActive = 'last_active';
    case Breached = 'breached';
}
