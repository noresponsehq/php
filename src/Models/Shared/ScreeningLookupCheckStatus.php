<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** found: a source found the identifier. not_found: every source answered and none found it. partial: the sources that answered found nothing and the others did not answer. not_covered: no source answered. A lookup that failed reads partial or not_covered, not not_found. */
enum ScreeningLookupCheckStatus: string
{
    case Found = 'found';
    case NotFound = 'not_found';
    case Partial = 'partial';
    case NotCovered = 'not_covered';
}
