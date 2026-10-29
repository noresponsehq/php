<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Reviews - Reviews created in [from,to) whose review and current account assessment remain retained. Status and assignment are current at as_of, not a transition history. label_coverage numerator is resolved reviews labeled benign or abuse; denominator is resolved reviews. Inconclusive is not a known outcome. Review conclusions do not change account feedback or enforcement. */
class Reviews
{
    /**
     *
     * @var int $denominator
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('denominator')]
    public int $denominator;

    /**
     *
     * @var int $open
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('open')]
    public int $open;

    /**
     *
     * @var int $inProgress
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('in_progress')]
    public int $inProgress;

    /**
     *
     * @var int $resolved
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('resolved')]
    public int $resolved;

    /**
     *
     * @var int $assigned
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assigned')]
    public int $assigned;

    /**
     *
     * @var int $unassigned
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('unassigned')]
    public int $unassigned;

    /**
     * Counts only; a zero denominator means no eligible retained records and does not imply a zero rate.
     *
     * @var \NoResponse\Models\Shared\Coverage $labelCoverage
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('label_coverage')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Coverage')]
    public Coverage $labelCoverage;

    /**
     * Current resolution of each resolved retained review; prior resolutions and reopened reviews do not count. Missing keys mean zero. These investigation conclusions are independent of account feedback.
     *
     * @var \NoResponse\Models\Shared\ReviewsConclusions $conclusions
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('conclusions')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReviewsConclusions')]
    public ReviewsConclusions $conclusions;

    /**
     *
     * @var string $population
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('population')]
    public string $population;

    /**
     * @param  string  $population
     * @param  int  $denominator
     * @param  int  $open
     * @param  int  $inProgress
     * @param  int  $resolved
     * @param  int  $assigned
     * @param  int  $unassigned
     * @param  \NoResponse\Models\Shared\Coverage  $labelCoverage
     * @param  \NoResponse\Models\Shared\ReviewsConclusions  $conclusions
     * @phpstan-pure
     */
    public function __construct(int $denominator, int $open, int $inProgress, int $resolved, int $assigned, int $unassigned, Coverage $labelCoverage, ReviewsConclusions $conclusions, string $population = 'retained_reviews_by_created_at')
    {
        $this->denominator = $denominator;
        $this->open = $open;
        $this->inProgress = $inProgress;
        $this->resolved = $resolved;
        $this->assigned = $assigned;
        $this->unassigned = $unassigned;
        $this->labelCoverage = $labelCoverage;
        $this->conclusions = $conclusions;
        $this->population = $population;
    }
}