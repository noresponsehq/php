<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** applied when the identity provider accepted the action, failed when it refused it or could not be reached. Only applied counts as enforced. */
enum EnforcementStatus: string
{
    case Applied = 'applied';
    case Failed = 'failed';
}
