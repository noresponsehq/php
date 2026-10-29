<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum Band: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
    case Critical = 'critical';
}
