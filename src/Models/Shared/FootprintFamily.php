<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The source-neutral kind of evidence: account_presence (an account found on a site), auth_provider (the account at your auth provider), breach (breach and credential tables), breach_abuse (abuse and fraud communities' tables) and code_hosting (a code hosting profile). */
enum FootprintFamily: string
{
    case AccountPresence = 'account_presence';
    case AuthProvider = 'auth_provider';
    case Breach = 'breach';
    case BreachAbuse = 'breach_abuse';
    case CodeHosting = 'code_hosting';
}
