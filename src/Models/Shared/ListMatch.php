<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The action of the list entry that decided the account. */
enum ListMatch: string
{
    case Block = 'block';
    case Allow = 'allow';
}
