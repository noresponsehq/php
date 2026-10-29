<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** first_answers uses anonymous counters that can include erased detail. retained_first_answers computes exact intersections over retained first answers within 31 days. Requests exceeding the 100000-record work budget are refused. */
enum Population: string
{
    case FirstAnswers = 'first_answers';
    case RetainedFirstAnswers = 'retained_first_answers';
}
