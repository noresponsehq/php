<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum EnrichmentChangeKind: string
{
    case Username = 'username';
    case Email = 'email';
    case Phone = 'phone';
    case PersonName = 'person_name';
}
