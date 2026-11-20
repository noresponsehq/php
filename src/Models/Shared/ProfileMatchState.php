<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** How sure the screening is that a profile is the person's, from the likelihood its record scores. Confirmed reaches the join bar of 0.9. Probable reaches 0.85, which takes a shared value beyond the one that found the account. Possible is the rest. */
enum ProfileMatchState: string
{
    case Confirmed = 'confirmed';
    case Probable = 'probable';
    case Possible = 'possible';
}
