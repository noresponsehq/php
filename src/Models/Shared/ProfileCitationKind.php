<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** record: a record in lookup.records or profiles[].record. post: an item in posts. check: an item in lookup.checks. */
enum ProfileCitationKind: string
{
    case Record = 'record';
    case Post = 'post';
    case Check = 'check';
}
