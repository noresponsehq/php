<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class AccountRisk
{
    /**
     * 0 (safe) to 100 (risky), as risk.score of the assessment.
     *
     * @var int $score
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('score')]
    public int $score;

    /**
     * block when the score reached your block threshold (risk.block of the assessment), otherwise the assessment's recommendation. held only for a flow whose admission is held (settings flows.<flow>.admission), when the account's current assessment was made for that flow and its investigation has not completed (status partial): the final decision arrives as account.risk_changed when the investigation completes, decided by its score, or when the hold's deadline (hold_seconds after the assessment was created) passes first, as the flow's on_expiry action or the decision the evidence so far gives, whichever is stricter. Your application applies it.
     *
     * @var \NoResponse\Models\Shared\AccountDecision|string $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountDecision|string')]
    public AccountDecision|string $decision;

    /**
     * Every reason that fired: risk-raising reasons first, then neutral, then risk-lowering, each strongest impact band first and then by code. The policy's numeric weights are kept private, so a reason carries only its direction and impact band.
     *
     * @var array<\NoResponse\Models\Shared\AccountRiskReason> $reasons
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reasons')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AccountRiskReason>')]
    public array $reasons;

    /**
     * @param  int  $score
     * @param  \NoResponse\Models\Shared\AccountDecision|string  $decision
     * @param  array<\NoResponse\Models\Shared\AccountRiskReason>  $reasons
     * @phpstan-pure
     */
    public function __construct(int $score, AccountDecision|string $decision, array $reasons)
    {
        $this->score = $score;
        $this->decision = $decision;
        $this->reasons = $reasons;
    }
}