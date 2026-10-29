<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** assessments only. */
enum UsageCountDepth: string
{
    case Quick = 'quick';
    case Full = 'full';
}
