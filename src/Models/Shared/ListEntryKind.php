<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** email matches one address, whatever the case of its local part. email_domain matches every address of the registrable domain and of its subdomains. */
enum ListEntryKind: string
{
    case Email = 'email';
    case EmailDomain = 'email_domain';
}
