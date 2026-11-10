<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** How sure the screening is that a profile is the attendee's, from its evidence: confirmed is a handle on the attendee row, or two or more hard identifiers (email, phone, a supplied handle, or a fact an existing source returned); probable is one identifier beyond the name; possible is the name alone. */
enum ProfileMatchState: string
{
    case Confirmed = 'confirmed';
    case Probable = 'probable';
    case Possible = 'possible';
}
