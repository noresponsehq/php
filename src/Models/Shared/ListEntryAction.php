<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** block decides block for the accounts the entry matches; allow decides allow. Block wins when both match. */
enum ListEntryAction: string
{
    case Block = 'block';
    case Allow = 'allow';
}
