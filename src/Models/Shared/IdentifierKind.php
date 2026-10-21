<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Which submitted identifier a signal concerns. ip is a selector of breach_exposure only. */
enum IdentifierKind: string
{
    case Email = 'email';
    case Username = 'username';
    case Phone = 'phone';
    case Ip = 'ip';
}
