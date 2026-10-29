<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PolicyEvaluationRequest
{
    /**
     *
     * @var int $expectedPolicyVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expected_policy_version')]
    public int $expectedPolicyVersion;

    /**
     *
     * @var string $from
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('from')]
    public string $from;

    /**
     *
     * @var string $to
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('to')]
    public string $to;

    /**
     * $candidates
     *
     * @var array<\NoResponse\Models\Shared\Thresholds> $candidates
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('candidates')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Thresholds>')]
    public array $candidates;

    /**
     *
     * @var \NoResponse\Models\Shared\PolicyEvaluationRequestCosts $costs
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('costs')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PolicyEvaluationRequestCosts')]
    public PolicyEvaluationRequestCosts $costs;

    /**
     *
     * @var \NoResponse\Models\Shared\PolicyEvaluationRequestLimits $limits
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('limits')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PolicyEvaluationRequestLimits')]
    public PolicyEvaluationRequestLimits $limits;

    /**
     *
     * @var string $labelCollection
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('label_collection')]
    public string $labelCollection;

    /**
     *
     * @var string $splitSeed
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('split_seed')]
    public string $splitSeed;

    /**
     * @param  int  $expectedPolicyVersion
     * @param  string  $from
     * @param  string  $to
     * @param  array<\NoResponse\Models\Shared\Thresholds>  $candidates
     * @param  \NoResponse\Models\Shared\PolicyEvaluationRequestCosts  $costs
     * @param  \NoResponse\Models\Shared\PolicyEvaluationRequestLimits  $limits
     * @param  string  $labelCollection
     * @param  string  $splitSeed
     * @phpstan-pure
     */
    public function __construct(int $expectedPolicyVersion, string $from, string $to, array $candidates, PolicyEvaluationRequestCosts $costs, PolicyEvaluationRequestLimits $limits, string $labelCollection, string $splitSeed)
    {
        $this->expectedPolicyVersion = $expectedPolicyVersion;
        $this->from = $from;
        $this->to = $to;
        $this->candidates = $candidates;
        $this->costs = $costs;
        $this->limits = $limits;
        $this->labelCollection = $labelCollection;
        $this->splitSeed = $splitSeed;
    }
}