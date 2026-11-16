<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Present only when status is failed. no_writer: no profile writer serves this environment. refused: the model refused. not_written: the answer was not a profile, or no statement survived grounding. uncited_statement: a statement or lead cited a record the person does not hold. not_answered: the writer did not answer. worker_attempts_exhausted: the worker stopped retrying. */
enum WrittenProfileErrorCode: string
{
    case NoWriter = 'no_writer';
    case Refused = 'refused';
    case NotWritten = 'not_written';
    case UncitedStatement = 'uncited_statement';
    case NotAnswered = 'not_answered';
    case WorkerAttemptsExhausted = 'worker_attempts_exhausted';
}
