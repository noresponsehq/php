<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Per-signal outcome. A source that timed out, was blocked or errored reports blocked, unavailable or inconclusive with a reason and is listed in incomplete_sources; not_found is a definite absence. */
enum SignalOutcome: string
{
    case Found = 'found';
    case NotFound = 'not_found';
    case Inconclusive = 'inconclusive';
    case Blocked = 'blocked';
    case Unavailable = 'unavailable';
}
