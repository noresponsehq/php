<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Risk - The one risk decision for this event. score is 0 (safe) to 100 (risky): the sum of the weights of the reasons that fired, clamped to 0 to 100, from hand-set versioned weights. Every answer with a recommendation carries it, and the top-level recommendation equals risk.recommendation. It names no source or provider. */
class Risk
{
    /**
     *
     * @var int $score
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('score')]
    public int $score;

    /**
     * low 0-29, medium 30-59, high 60-84, critical 85-100.
     *
     * @var \NoResponse\Models\Shared\Band $band
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('band')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Band')]
    public Band $band;

    /**
     * The recommended action: allow, step_up or review. Your application applies it.
     *
     * @var \NoResponse\Models\Shared\Recommendation $recommendation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('recommendation')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Recommendation')]
    public Recommendation $recommendation;

    /**
     * How much of the planned evidence answered; it says nothing about risk.
     *
     * @var \NoResponse\Models\Shared\RiskConfidence $confidence
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('confidence')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RiskConfidence')]
    public RiskConfidence $confidence;

    /**
     * Version of the hand-authored heuristic weights that produced the recommendation, for example 'risk-2026-10.7'. A workspace threshold override adds a +t<N> suffix, e.g. 'risk-2026-10.7+t3'.
     *
     * @var string $policyVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('policy_version')]
    public string $policyVersion;

    /**
     * Every reason that fired, highest weight first. The weights sum to score before clamping.
     *
     * @var array<\NoResponse\Models\Shared\RiskReason> $reasons
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reasons')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\RiskReason>')]
    public array $reasons;

    /**
     * Sources counted by state, not named.
     *
     * @var \NoResponse\Models\Shared\RiskCoverage $coverage
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('coverage')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RiskCoverage')]
    public RiskCoverage $coverage;

    /**
     * true when the workspace's block threshold is set and score reached it. A provider hook can deny the account creation on it; the provider decides and enforces. It does not change recommendation. It is false while blocking is off, the default, and a body from before the flag existed omits it: read absent as false.
     *
     * @var ?bool $block
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('block')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $block = null;

    /**
     * The block threshold this answer used: block is true exactly when score is at least this value. Absent while blocking is off. NoResponse sets it per workspace on request, at or above the review threshold.
     *
     * @var ?int $blockThreshold
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('block_threshold')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $blockThreshold = null;

    /**
     * A few typed facts per identifier. Every fact is optional: absent means the evidence did not answer and makes no claim, while false or 0 is a definite answer. Lanes that do not exist yet leave their members absent.
     *
     * @var ?\NoResponse\Models\Shared\RiskSummary $summary
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('summary')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RiskSummary|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?RiskSummary $summary = null;

    /**
     * Detailed view only (response_mode=detailed, which needs the detailed scope); a standard answer leaves it out. Merged observations without provider, source, origin, raw breach record, value or score.
     *
     * @var ?\NoResponse\Models\Shared\RiskDetails $details
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('details')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RiskDetails|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?RiskDetails $details = null;

    /**
     * Labels the v0 policy as hand-authored and not statistically validated.
     *
     * @var string $policyBasis
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('policy_basis')]
    public string $policyBasis;

    /**
     * @param  int  $score
     * @param  \NoResponse\Models\Shared\Band  $band
     * @param  \NoResponse\Models\Shared\Recommendation  $recommendation
     * @param  \NoResponse\Models\Shared\RiskConfidence  $confidence
     * @param  string  $policyVersion
     * @param  string  $policyBasis
     * @param  array<\NoResponse\Models\Shared\RiskReason>  $reasons
     * @param  \NoResponse\Models\Shared\RiskCoverage  $coverage
     * @param  ?bool  $block
     * @param  ?int  $blockThreshold
     * @param  ?\NoResponse\Models\Shared\RiskSummary  $summary
     * @param  ?\NoResponse\Models\Shared\RiskDetails  $details
     * @phpstan-pure
     */
    public function __construct(int $score, Band $band, Recommendation $recommendation, RiskConfidence $confidence, string $policyVersion, array $reasons, RiskCoverage $coverage, ?bool $block = null, ?int $blockThreshold = null, ?RiskSummary $summary = null, ?RiskDetails $details = null, string $policyBasis = 'heuristic_unvalidated')
    {
        $this->score = $score;
        $this->band = $band;
        $this->recommendation = $recommendation;
        $this->confidence = $confidence;
        $this->policyVersion = $policyVersion;
        $this->reasons = $reasons;
        $this->coverage = $coverage;
        $this->block = $block;
        $this->blockThreshold = $blockThreshold;
        $this->summary = $summary;
        $this->details = $details;
        $this->policyBasis = $policyBasis;
    }
}