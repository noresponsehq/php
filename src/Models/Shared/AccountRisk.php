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
     * block when the score reached your block threshold (risk.block of the assessment), otherwise the assessment's recommendation. Your application applies it.
     *
     * @var \NoResponse\Models\Shared\AccountDecision $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountDecision')]
    public AccountDecision $decision;

    /**
     * Every reason that fired, highest weight first. The weights sum to score before clamping.
     *
     * @var array<\NoResponse\Models\Shared\AccountRiskReason> $reasons
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reasons')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AccountRiskReason>')]
    public array $reasons;

    /**
     * @param  int  $score
     * @param  \NoResponse\Models\Shared\AccountDecision  $decision
     * @param  array<\NoResponse\Models\Shared\AccountRiskReason>  $reasons
     * @phpstan-pure
     */
    public function __construct(int $score, AccountDecision $decision, array $reasons)
    {
        $this->score = $score;
        $this->decision = $decision;
        $this->reasons = $reasons;
    }
}