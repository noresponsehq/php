<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum Identifier: string
{
    case Email = 'email';
    case Username = 'username';
}
