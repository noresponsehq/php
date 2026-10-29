<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PolicyPreview - Exact threshold transitions among eligible retained first answers, newest first within the limit. Partial older revisions without a frozen hold snapshot are reported as unsupported. Preview leaves account state, outcomes and source evidence unchanged. */
class PolicyPreview
{
    /**
     *
     * @var int $policyVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('policy_version')]
    public int $policyVersion;

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
     * @var string $retentionFrom
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('retention_from')]
    public string $retentionFrom;

    /**
     *
     * @var \NoResponse\Models\Shared\PolicyPreviewCoverage $coverage
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('coverage')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PolicyPreviewCoverage')]
    public PolicyPreviewCoverage $coverage;

    /**
     *
     * @var int $changed
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('changed')]
    public int $changed;

    /**
     *
     * @var int $unchanged
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('unchanged')]
    public int $unchanged;

    /**
     * $transitions
     *
     * @var array<\NoResponse\Models\Shared\PolicyPreviewTransition> $transitions
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('transitions')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\PolicyPreviewTransition>')]
    public array $transitions;

    /**
     *
     * @var string $scope
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('scope')]
    public string $scope;

    /**
     * @param  string  $scope
     * @param  int  $policyVersion
     * @param  string  $from
     * @param  string  $to
     * @param  string  $retentionFrom
     * @param  \NoResponse\Models\Shared\PolicyPreviewCoverage  $coverage
     * @param  int  $changed
     * @param  int  $unchanged
     * @param  array<\NoResponse\Models\Shared\PolicyPreviewTransition>  $transitions
     * @phpstan-pure
     */
    public function __construct(int $policyVersion, string $from, string $to, string $retentionFrom, PolicyPreviewCoverage $coverage, int $changed, int $unchanged, array $transitions, string $scope = 'retained_first_answer_thresholds')
    {
        $this->policyVersion = $policyVersion;
        $this->from = $from;
        $this->to = $to;
        $this->retentionFrom = $retentionFrom;
        $this->coverage = $coverage;
        $this->changed = $changed;
        $this->unchanged = $unchanged;
        $this->transitions = $transitions;
        $this->scope = $scope;
    }
}