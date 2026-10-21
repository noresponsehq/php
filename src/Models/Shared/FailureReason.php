<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Why a signal or source did not produce a definite found/not_found. timed_out means the source missed the request deadline; a continuation may still settle it. deferred means the (source, identifier) pair is async-only and was not attempted on the synchronous path; a continuation settles it. */
enum FailureReason: string
{
    case TimedOut = 'timed_out';
    case RateLimited = 'rate_limited';
    case Blocked = 'blocked';
    case SourceError = 'source_error';
    case Unavailable = 'unavailable';
    case Deferred = 'deferred';
    case InsufficientEvidence = 'insufficient_evidence';
}
