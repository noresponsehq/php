<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The kind of the value searched. */
enum SearchKind: string
{
    case Email = 'email';
    case Phone = 'phone';
    case Username = 'username';
    case PersonName = 'person_name';
    case Password = 'password';
    case Hash = 'hash';
    case Ip = 'ip';
}
