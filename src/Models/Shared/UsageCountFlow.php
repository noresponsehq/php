<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** assessments only. */
enum UsageCountFlow: string
{
    case AccountCreation = 'account_creation';
    case Login = 'login';
    case Purchase = 'purchase';
}
