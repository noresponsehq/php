<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The period each count covers, in UTC; a week starts on Monday. */
enum Bucket: string
{
    case Hour = 'hour';
    case Day = 'day';
    case Week = 'week';
}
