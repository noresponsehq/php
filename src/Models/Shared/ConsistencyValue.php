<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** How a submitted identifier agrees with what the evidence holds for the other identifiers. unknown is a definite 'cannot tell' (for example a truncated or too-common breach result); absent means the comparison was not made. */
enum ConsistencyValue: string
{
    case Match = 'match';
    case Partial = 'partial';
    case Mismatch = 'mismatch';
    case Unknown = 'unknown';
}
