<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** low 0-29, medium 30-59, high 60-84, critical 85-100. */
enum Band: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
    case Critical = 'critical';
}
