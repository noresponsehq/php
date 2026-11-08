<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** unchanged: the row matched an attendee with the same details. */
enum AttendeeBatchItemOutcome: string
{
    case Created = 'created';
    case Updated = 'updated';
    case Unchanged = 'unchanged';
}
