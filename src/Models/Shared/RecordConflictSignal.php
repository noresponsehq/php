<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** anchors_disagree: records found by two of the identifiers you gave clash with each other, so those identifiers may belong to different people. */
enum RecordConflictSignal: string
{
    case AnchorsDisagree = 'anchors_disagree';
}
