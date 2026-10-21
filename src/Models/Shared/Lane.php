<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** An evidence lane: accounts (account presence for email and username), phone, breach and ip. */
enum Lane: string
{
    case Accounts = 'accounts';
    case Phone = 'phone';
    case Breach = 'breach';
    case Ip = 'ip';
}
