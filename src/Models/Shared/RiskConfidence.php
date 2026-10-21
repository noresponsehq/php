<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** How much of the planned evidence answered; it says nothing about risk. */
enum RiskConfidence: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
}
