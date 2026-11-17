<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The kind of the value: one of the kinds the environment's enrichment setting names. */
enum SuggestedSearchKind: string
{
    case Username = 'username';
    case Email = 'email';
    case Phone = 'phone';
}
