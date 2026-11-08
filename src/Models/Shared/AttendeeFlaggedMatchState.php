<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** How sure the screening is that the accounts it read are the attendee's. A finding on a possible match is at most moderate, on a probable match at most high. */
enum AttendeeFlaggedMatchState: string
{
    case Confirmed = 'confirmed';
    case Probable = 'probable';
    case Possible = 'possible';
    case NoneFound = 'none_found';
    case Inaccessible = 'inaccessible';
}
