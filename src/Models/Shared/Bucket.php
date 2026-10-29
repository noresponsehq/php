<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The period each count covers: an hour, or a day or a week (from Monday) in time_zone. Hour buckets are whole UTC hours in any time zone. */
enum Bucket: string
{
    case Hour = 'hour';
    case Day = 'day';
    case Week = 'week';
}
