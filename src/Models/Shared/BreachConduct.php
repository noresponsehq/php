<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** What a breach table's rows record against the identifier: chargeback, one or more chargebacks; declined_payment, one or more declined payments; forum_sanction, a forum ban, warning or infraction. A category and not a value: the schema has no member for one. */
enum BreachConduct: string
{
    case Chargeback = 'chargeback';
    case DeclinedPayment = 'declined_payment';
    case ForumSanction = 'forum_sanction';
}
