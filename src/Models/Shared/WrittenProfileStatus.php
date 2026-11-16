<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** queued: the profile is being written. written: summary, statements and leads hold it. failed: it could not be written; error_code says why and no content is returned. */
enum WrittenProfileStatus: string
{
    case Queued = 'queued';
    case Written = 'written';
    case Failed = 'failed';
}
