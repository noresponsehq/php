<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum KeyKind: string
{
    case Service = 'service';
    case Personal = 'personal';
}
