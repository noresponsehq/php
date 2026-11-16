<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** stated: read from a record. inferred: reasoned from several facts. absence: every source answered and none found it. */
enum Basis: string
{
    case Stated = 'stated';
    case Inferred = 'inferred';
    case Absence = 'absence';
}
