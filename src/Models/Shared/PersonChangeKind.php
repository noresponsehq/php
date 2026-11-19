<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** account_added and account_removed: an account or profile appeared or disappeared. breach_added and breach_removed: a breach record appeared or disappeared. identifier_added and identifier_removed: an email, phone, username, name or account id on an account the person already held. field_changed: another field on such an account. finding_added: a new finding. posts_added: new posts, counted in count. */
enum PersonChangeKind: string
{
    case AccountAdded = 'account_added';
    case AccountRemoved = 'account_removed';
    case BreachAdded = 'breach_added';
    case BreachRemoved = 'breach_removed';
    case IdentifierAdded = 'identifier_added';
    case IdentifierRemoved = 'identifier_removed';
    case FieldChanged = 'field_changed';
    case FindingAdded = 'finding_added';
    case PostsAdded = 'posts_added';
}
