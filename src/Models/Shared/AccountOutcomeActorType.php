<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum AccountOutcomeActorType: string
{
    case ApiKey = 'api_key';
    case User = 'user';
}
