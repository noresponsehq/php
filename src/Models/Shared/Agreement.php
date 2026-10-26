<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum Agreement: string
{
    case Match = 'match';
    case Partial = 'partial';
    case Mismatch = 'mismatch';
}
