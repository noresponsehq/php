<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountDecisionsByFlow - The decision for each flow. Every flow uses the tenant's signup thresholds today, so all three are equal. */
class AccountDecisionsByFlow
{
    /**
     * block when the score reached your block threshold (risk.block of the assessment), otherwise the assessment's recommendation. Your application applies it.
     *
     * @var \NoResponse\Models\Shared\AccountDecision $signup
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('signup')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountDecision')]
    public AccountDecision $signup;

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
     * @param  \NoResponse\Models\Shared\AccountDecision  $signup
     * @param  \NoResponse\Models\Shared\AccountDecision  $login
     * @param  \NoResponse\Models\Shared\AccountDecision  $purchase
     * @phpstan-pure
     */
    public function __construct(AccountDecision $signup, AccountDecision $login, AccountDecision $purchase)
    {
        $this->signup = $signup;
        $this->login = $login;
        $this->purchase = $purchase;
    }
}