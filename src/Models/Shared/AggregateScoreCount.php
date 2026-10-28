<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AggregateScoreCount - First answers of one flow whose risk.score is in [score_min, score_max]: 0-4, 5-9 up to 95-100. A pending answer has no score. */
class AggregateScoreCount
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
     *
     * @var int $count
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('count')]
    public int $count;

    /**
     * @param  \NoResponse\Models\Shared\Flow|string  $flow
     * @param  int  $scoreMin
     * @param  int  $scoreMax
     * @param  int  $count
     * @phpstan-pure
     */
    public function __construct(Flow|string $flow, int $scoreMin, int $scoreMax, int $count)
    {
        $this->flow = $flow;
        $this->scoreMin = $scoreMin;
        $this->scoreMax = $scoreMax;
        $this->count = $count;
    }
}