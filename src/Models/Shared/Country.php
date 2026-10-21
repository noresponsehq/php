<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** IP country, phone country, breach countries and policy_context.region together. */
enum Country: string
{
    case Consistent = 'consistent';
    case Mismatch = 'mismatch';
    case Unknown = 'unknown';
}
