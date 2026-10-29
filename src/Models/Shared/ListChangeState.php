<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ListChangeState: string
{
    case Propagating = 'propagating';
    case Completed = 'completed';
}
