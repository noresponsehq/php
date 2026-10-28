<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AggregateScoreOutcome - First answers of one flow whose risk.score is in [score_min, score_max] and whose assessment's latest reported outcome (the latest received) is outcome. Counted when the first answer is counted and moved when a later outcome wins; outcomes reported before the first answer was counted are counted with it. An outcome reported before this count existed is counted only once another outcome is reported for the assessment. */
class AggregateScoreOutcome
{
    /**
     * The event an assessment is made for: account_creation (a user creates an account), login (a user returns to an existing account) or purchase (a payment or a credit grant). The account's risk is reported with the decision for this flow.
     *
     * @var \NoResponse\Models\Shared\Flow|string $flow
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flow')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Flow|string')]
    public Flow|string $flow;

    /**
     * A multiple of 5.
     *
     * @var int $scoreMin
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('score_min')]
    public int $scoreMin;

    /**
     *
     * @var int $scoreMax
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('score_max')]
    public int $scoreMax;

    /**
     * What the provider later learned about the assessed account. confirmed_abuse, account_takeover and chargeback report abuse; false_positive and legitimate withdraw an earlier abuse report of this workspace for the assessment; unknown is recorded only. Outcomes are append-only and the latest one recorded for an assessment wins.
     *
     * @var \NoResponse\Models\Shared\Outcome|string $outcome
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('outcome')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Outcome|string')]
    public Outcome|string $outcome;

    /**
     *
     * @var int $count
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('count')]
    public int $count;

    /**
     * @param  \NoResponse\Models\Shared\Flow|string  $flow
     * @param  int  $scoreMin
     * @param  int  $scoreMax
     * @param  \NoResponse\Models\Shared\Outcome|string  $outcome
     * @param  int  $count
     * @phpstan-pure
     */
    public function __construct(Flow|string $flow, int $scoreMin, int $scoreMax, Outcome|string $outcome, int $count)
    {
        $this->flow = $flow;
        $this->scoreMin = $scoreMin;
        $this->scoreMax = $scoreMax;
        $this->outcome = $outcome;
        $this->count = $count;
    }
}