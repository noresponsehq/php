<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** A reviewer's overrule (POST .../people/{person_id}/records), which decides joined whatever the likelihood and sticks for as long as a lookup finds the same record. Absent when nobody overruled it. */
enum Verdict: string
{
    case Joined = 'joined';
    case Rejected = 'rejected';
}
