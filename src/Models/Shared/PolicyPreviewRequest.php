<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PolicyPreviewRequest - Side-effect-free threshold preview for at most 31 days. Retained first answers are evaluated at their exact frozen scores using the production threshold and hold rules. Changes to admission, source selection, depth or retention are not simulated. */
class PolicyPreviewRequest
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
     *
     * @var \NoResponse\Models\Shared\PolicyPreviewRequestFlows $flows
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flows')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PolicyPreviewRequestFlows')]
    public PolicyPreviewRequestFlows $flows;

    /**
     *
     * @var ?int $limit
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('limit')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $limit = null;

    /**
     * @param  int  $expectedPolicyVersion
     * @param  string  $from
     * @param  string  $to
     * @param  \NoResponse\Models\Shared\PolicyPreviewRequestFlows  $flows
     * @param  ?int  $limit
     * @phpstan-pure
     */
    public function __construct(int $expectedPolicyVersion, string $from, string $to, PolicyPreviewRequestFlows $flows, ?int $limit = 1000)
    {
        $this->expectedPolicyVersion = $expectedPolicyVersion;
        $this->from = $from;
        $this->to = $to;
        $this->flows = $flows;
        $this->limit = $limit;
    }
}