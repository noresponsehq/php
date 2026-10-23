<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The event an assessment is made for: account_creation (a user creates an account), login (a user returns to an existing account) or purchase (a payment or a credit grant). The account's risk is reported with the decision for this flow. */
enum Flow: string
{
    case AccountCreation = 'account_creation';
    case Login = 'login';
    case Purchase = 'purchase';
}
