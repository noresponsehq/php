<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ScreeningSpendLineRole: string
{
    case Resolver = 'resolver';
    case Collector = 'collector';
    case Analyser = 'analyser';
}
