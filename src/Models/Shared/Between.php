<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum Between: string
{
    case Email = 'email';
    case Phone = 'phone';
}
