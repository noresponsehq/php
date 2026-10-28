<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AggregateLateFlip - Changes of the account decision for an assessment's flow after its first answer, as account.risk_changed announces them, counted in the bucket of the assessment's creation. from is the decision announced before (allow before the first announcement); an assessment that changes twice counts twice. */
class AggregateLateFlip
{
    /**
     * block when the score reached your block threshold (risk.block of the assessment), otherwise the assessment's recommendation. held only for a flow whose admission is held (settings flows.<flow>.admission), when the account's current assessment was made for that flow and its investigation has not completed (status partial): the final decision arrives as account.risk_changed when the investigation completes, decided by its score, or when the hold's deadline (hold_seconds after the assessment was created) passes first, as the flow's on_expiry action or the decision the evidence so far gives, whichever is stricter. Your application applies it.
     *
     * @var \NoResponse\Models\Shared\AccountDecision|string $from
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('from')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountDecision|string')]
    public AccountDecision|string $from;

    /**
     * block when the score reached your block threshold (risk.block of the assessment), otherwise the assessment's recommendation. held only for a flow whose admission is held (settings flows.<flow>.admission), when the account's current assessment was made for that flow and its investigation has not completed (status partial): the final decision arrives as account.risk_changed when the investigation completes, decided by its score, or when the hold's deadline (hold_seconds after the assessment was created) passes first, as the flow's on_expiry action or the decision the evidence so far gives, whichever is stricter. Your application applies it.
     *
     * @var \NoResponse\Models\Shared\AccountDecision|string $to
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('to')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountDecision|string')]
    public AccountDecision|string $to;

    /**
     * How long after the assessment's creation the change was made.
     *
     * @var \NoResponse\Models\Shared\Delay|string $delay
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('delay')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Delay|string')]
    public Delay|string $delay;

    /**
     *
     * @var int $count
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('count')]
    public int $count;

    /**
     * @param  \NoResponse\Models\Shared\AccountDecision|string  $from
     * @param  \NoResponse\Models\Shared\AccountDecision|string  $to
     * @param  \NoResponse\Models\Shared\Delay|string  $delay
     * @param  int  $count
     * @phpstan-pure
     */
    public function __construct(AccountDecision|string $from, AccountDecision|string $to, Delay|string $delay, int $count)
    {
        $this->from = $from;
        $this->to = $to;
        $this->delay = $delay;
        $this->count = $count;
    }
}