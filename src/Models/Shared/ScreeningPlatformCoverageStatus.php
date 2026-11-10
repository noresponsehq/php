<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** covered read at least one profile; none_found looked and found no account; inaccessible found accounts that are private or locked; failed could not finish looking; unavailable has no resolver or collector enabled. */
enum ScreeningPlatformCoverageStatus: string
{
    case Covered = 'covered';
    case NoneFound = 'none_found';
    case Inaccessible = 'inaccessible';
    case Failed = 'failed';
    case Unavailable = 'unavailable';
}
