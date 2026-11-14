<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The person's role in the group: guest (a ticket holder), crew, vendor or press. Leave it out when you do not know it: a person without one has no role, not guest. A later row naming the same person replaces it, and a change of role alone keeps the person's screening results. */
enum PersonRole: string
{
    case Guest = 'guest';
    case Crew = 'crew';
    case Vendor = 'vendor';
    case Press = 'press';
}
