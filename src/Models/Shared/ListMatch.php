<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The list action captured at the first answer. Requires revision first. Older answers without captured list state do not match, including none. */
enum ListMatch: string
{
    case Allow = 'allow';
    case Block = 'block';
    case None = 'none';
}
