<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Required for username: the username submitted by this customer in this workspace/environment. It does not name or join a source platform. Omit for email and phone. */
enum NamespaceT: string
{
    case Customer = 'customer';
}
