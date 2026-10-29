<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The selected reason's served impact band. Requires reason. */
enum Impact: string
{
    case None = 'none';
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
}
