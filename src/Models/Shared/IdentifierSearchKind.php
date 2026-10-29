<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum IdentifierSearchKind: string
{
    case Email = 'email';
    case Phone = 'phone';
    case Username = 'username';
}
