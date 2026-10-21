<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The submitted identifier a breach table matched on: email or username. Phone and name are not breach selectors. */
enum BreachSelector: string
{
    case Email = 'email';
    case Username = 'username';
    case Ip = 'ip';
}
