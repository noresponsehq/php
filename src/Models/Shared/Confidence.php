<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Ordinal confidence in the recommendation under the current policy: low, medium, high or unavailable. */
enum Confidence: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
    case Unavailable = 'unavailable';
}
