<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Why a failed search found nothing: its sources did not answer, none could be asked, or it could not run before its attempts were spent. */
enum ErrorCode: string
{
    case NotAnswered = 'not_answered';
    case NoSource = 'no_source';
    case WorkerAttemptsExhausted = 'worker_attempts_exhausted';
}
