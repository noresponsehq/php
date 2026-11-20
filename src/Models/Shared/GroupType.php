<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** What the group's people share: an event, an organisation, a place or another attribute. */
enum GroupType: string
{
    case Event = 'event';
    case Organisation = 'organisation';
    case Place = 'place';
    case Custom = 'custom';
}
