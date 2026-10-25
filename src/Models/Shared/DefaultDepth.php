<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The depth a request for this flow that names none is served at. Defaults: full for account_creation and purchase, quick for login. */
enum DefaultDepth: string
{
    case Quick = 'quick';
    case Full = 'full';
}
