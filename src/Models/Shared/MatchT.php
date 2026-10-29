<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** exact compares the original submitted value; canonical uses identifier-specific normalisation; mailbox explicitly selects the email alias rules used by lists. */
enum MatchT: string
{
    case Exact = 'exact';
    case Canonical = 'canonical';
    case Mailbox = 'mailbox';
}
