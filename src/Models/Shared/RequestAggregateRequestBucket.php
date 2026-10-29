<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum RequestAggregateRequestBucket: string
{
    case Hour = 'hour';
    case Day = 'day';
}
