<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum MatchedOn: string
{
    case Email = 'email';
    case Phone = 'phone';
    case ExternalId = 'external_id';
}
