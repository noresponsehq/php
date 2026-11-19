<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** How often the person is investigated again: daily, weekly or monthly, counted from when the schedule was set; off runs no scheduled investigation. */
enum SchedulePeriod: string
{
    case Daily = 'daily';
    case Weekly = 'weekly';
    case Monthly = 'monthly';
    case Off = 'off';
}
