<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Evidence coverage: how much of the planned source evidence gave a definite answer. This is not confidence that an identity is genuine, agreement between identifiers, a risk score or a probability. unavailable means no usable evidence answered; a terminal uncovered assessment can have this value and recommend review. */
enum Confidence: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
    case Unavailable = 'unavailable';
}
