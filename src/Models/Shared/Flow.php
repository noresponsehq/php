<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The customer event an assessment is made for: signup (a new account), login (a returning sign-in) or purchase (a payment or credit grant). The account's risk is reported with the decision for this flow. */
enum Flow: string
{
    case Signup = 'signup';
    case Login = 'login';
    case Purchase = 'purchase';
}
