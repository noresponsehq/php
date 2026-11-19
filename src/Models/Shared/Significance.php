<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** One rule ranks every change: identity changes (accounts, breaches, identifiers) are high, profile fields and findings are medium, new posts are low. */
enum Significance: string
{
    case High = 'high';
    case Medium = 'medium';
    case Low = 'low';
}
