<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ListAttendeesRole: string
{
    case Guest = 'guest';
    case Crew = 'crew';
    case Vendor = 'vendor';
    case Press = 'press';
    case Unstated = 'unstated';
}
