<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** How sure the latest screening is that it found the person's accounts. unscreened until a screening reaches the person, and after one that had no profile to check (no_profile_to_check). */
enum MatchState: string
{
    case Unscreened = 'unscreened';
    case Confirmed = 'confirmed';
    case Probable = 'probable';
    case Possible = 'possible';
    case NoneFound = 'none_found';
    case Inaccessible = 'inaccessible';
}
