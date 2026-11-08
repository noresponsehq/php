<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** How sure the latest screening is that it found the attendee's accounts. unscreened until a screening reaches the attendee. */
enum MatchState: string
{
    case Unscreened = 'unscreened';
    case Confirmed = 'confirmed';
    case Probable = 'probable';
    case Possible = 'possible';
    case NoneFound = 'none_found';
    case Inaccessible = 'inaccessible';
}
