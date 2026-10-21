<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Freshness class of the evidence behind a signal. unknown whenever no evidence was obtained. */
enum Freshness: string
{
    case Fresh = 'fresh';
    case Stale = 'stale';
    case Unknown = 'unknown';
}
