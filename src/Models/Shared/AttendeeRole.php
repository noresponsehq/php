<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The attendee's role at the event: guest (a ticket holder), crew, vendor or press. Leave it out when you do not know it: an attendee without one has no role, not guest. A later row naming the same attendee replaces it, and a change of role alone keeps the attendee's screening results. */
enum AttendeeRole: string
{
    case Guest = 'guest';
    case Crew = 'crew';
    case Vendor = 'vendor';
    case Press = 'press';
}
