<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** IP country, phone country, breach countries and policy_context.region together. When the breach records give a country, the timezone and locale countries count too. The IP country of a proxy or hosting network does not count. */
enum Country: string
{
    case Consistent = 'consistent';
    case Mismatch = 'mismatch';
    case Unknown = 'unknown';
}
