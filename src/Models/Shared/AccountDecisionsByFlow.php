<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountDecisionsByFlow - The decision for each flow: the account's score under that flow's thresholds. A flow the workspace has not set uses its account_creation thresholds, so the flows differ only where it set them. */
class AccountDecisionsByFlow
{
    /**
     * block when the score reached your block threshold (risk.block of the assessment), otherwise the assessment's recommendation. Your application applies it.
     *
     * @var \NoResponse\Models\Shared\AccountDecision $accountCreation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_creation')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountDecision')]
    public AccountDecision $accountCreation;

    /**
     * block when the score reached your block threshold (risk.block of the assessment), otherwise the assessment's recommendation. Your application applies it.
     *
     * @var \NoResponse\Models\Shared\AccountDecision $login
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('login')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountDecision')]
    public AccountDecision $login;

    /**
     * block when the score reached your block threshold (risk.block of the assessment), otherwise the assessment's recommendation. Your application applies it.
     *
     * @var \NoResponse\Models\Shared\AccountDecision $purchase
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('purchase')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountDecision')]
    public AccountDecision $purchase;

    /**
     * @param  \NoResponse\Models\Shared\AccountDecision  $accountCreation
     * @param  \NoResponse\Models\Shared\AccountDecision  $login
     * @param  \NoResponse\Models\Shared\AccountDecision  $purchase
     * @phpstan-pure
     */
    public function __construct(AccountDecision $accountCreation, AccountDecision $login, AccountDecision $purchase)
    {
        $this->accountCreation = $accountCreation;
        $this->login = $login;
        $this->purchase = $purchase;
    }
}