<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum Direction: string
{
    case Raises = 'raises';
    case Lowers = 'lowers';
    case Neutral = 'neutral';
}
