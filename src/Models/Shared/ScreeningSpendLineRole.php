<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** What the implementation did. analyser appears only on spend recorded before the engine stopped analysing posts. */
enum ScreeningSpendLineRole: string
{
    case Resolver = 'resolver';
    case Collector = 'collector';
    case Analyser = 'analyser';
}
