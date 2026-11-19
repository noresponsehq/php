<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ai_typing and analysis appear only on searches recorded before the engine stopped analysing results. */
enum Stage: string
{
    case Lookup = 'lookup';
    case LookupTyping = 'lookup_typing';
    case Platforms = 'platforms';
    case Written = 'written';
    case LatePlatforms = 'late_platforms';
    case LateLookup = 'late_lookup';
    case AiTyping = 'ai_typing';
    case Analysis = 'analysis';
    case Rating = 'rating';
}
