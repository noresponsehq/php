<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The credential namespace of the creator. An external user ID equal to an API-key label does not grant ownership of that key's private view. */
enum OwnerType: string
{
    case User = 'user';
    case ApiKey = 'api_key';
}
