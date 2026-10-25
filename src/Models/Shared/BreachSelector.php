<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The submitted email or username whose own search matched the table. A submitted full name is searched as well, and what it finds feeds the identity's reasons rather than this list. */
enum BreachSelector: string
{
    case Email = 'email';
    case Username = 'username';
    case Ip = 'ip';
}
