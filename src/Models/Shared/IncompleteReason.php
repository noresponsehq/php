<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Why a lane did not settle. deferred means the lane is asynchronous and still running; a continuation settles it. timed_out means the lane missed its deadline. insufficient_evidence is a settled inconclusive signal rather than an incomplete lane. */
enum IncompleteReason: string
{
    case TimedOut = 'timed_out';
    case RateLimited = 'rate_limited';
    case Blocked = 'blocked';
    case SourceError = 'source_error';
    case Unavailable = 'unavailable';
    case Deferred = 'deferred';
}
