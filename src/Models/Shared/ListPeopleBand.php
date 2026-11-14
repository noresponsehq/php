<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ListPeopleBand: string
{
    case Critical = 'critical';
    case High = 'high';
    case Moderate = 'moderate';
    case Low = 'low';
    case Info = 'info';
    case None = 'none';
}
