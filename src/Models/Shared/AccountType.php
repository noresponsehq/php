<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** personal, or business: an account a company or school manages. */
enum AccountType: string
{
    case Personal = 'personal';
    case Business = 'business';
}
