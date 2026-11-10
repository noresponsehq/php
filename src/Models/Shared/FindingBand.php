<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** How severe a finding is, most severe first. */
enum FindingBand: string
{
    case Critical = 'critical';
    case High = 'high';
    case Moderate = 'moderate';
    case Low = 'low';
    case Info = 'info';
}
