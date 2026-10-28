<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** How long after the assessment's creation the change was made. */
enum Delay: string
{
    case Under10s = 'under_10s';
    case Under1m = 'under_1m';
    case Under10m = 'under_10m';
    case Under1h = 'under_1h';
    case Under1d = 'under_1d';
    case Over1d = 'over_1d';
}
