<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** complete: final; nothing is still running. A lane that failed or missed its 10 s deadline stays listed in incomplete_sources, and confidence is lower. partial: a recommendation exists and at least one lane is still running or did not settle (see incomplete_sources). pending: nothing usable before the deadline; no recommendation yet, poll or wait for the webhook. */
enum Status: string
{
    case Complete = 'complete';
    case Partial = 'partial';
    case Pending = 'pending';
}
