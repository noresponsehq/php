<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum WaitingFor: string
{
    case Outcome = 'outcome';
    case Review = 'review';
}
