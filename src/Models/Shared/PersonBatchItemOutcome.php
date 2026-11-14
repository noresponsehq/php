<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** unchanged: the row matched a person with the same details. */
enum PersonBatchItemOutcome: string
{
    case Created = 'created';
    case Updated = 'updated';
    case Unchanged = 'unchanged';
}
