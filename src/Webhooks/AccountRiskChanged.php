<?php

declare(strict_types=1);

namespace NoResponse\Webhooks;

use NoResponse\Models\Shared\Account;
use NoResponse\Models\Shared\AccountDecisionsByFlow;

/**
 * The account's decision for at least one flow changed. account is the
 * account exactly as accounts->get returns it, with its new risk and
 * decisions; previousDecisionsByFlow holds the decisions it replaced. It is
 * not sent when the score moves within the same decision, nor for an
 * account's first risk.
 */
final class AccountRiskChanged
{
    public function __construct(
        public readonly Account $account,
        public readonly AccountDecisionsByFlow $previousDecisionsByFlow,
    ) {
    }
}
