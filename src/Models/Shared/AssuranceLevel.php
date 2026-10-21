<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Provider or OIDC assurance level, when the customer has mapped one. */
enum AssuranceLevel: string
{
    case Unknown = 'unknown';
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
}
