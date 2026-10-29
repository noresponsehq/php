<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum Priority: string
{
    case Low = 'low';
    case Normal = 'normal';
    case High = 'high';
    case Urgent = 'urgent';
}
