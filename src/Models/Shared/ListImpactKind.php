<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ListImpactKind: string
{
    case Email = 'email';
    case EmailDomain = 'email_domain';
}
