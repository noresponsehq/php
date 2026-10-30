<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** assessment requires one submission to satisfy the complete expression. account permits witnesses across retained submissions of one account and is supported only by POST /v1/accounts/search. No default: select scope explicitly. */
enum ScopeEnum: string
{
    case Assessment = 'assessment';
    case Account = 'account';
}
