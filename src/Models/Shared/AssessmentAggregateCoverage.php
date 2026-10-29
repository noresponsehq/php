<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentAggregateCoverage - Captured in the same database snapshot as the counts. Capture start times describe when counting began, not the earliest creation time counted: an older assessment may first answer later. Older outcomes are not inferred to be absent. Erased detail cannot be returned by drill-down even while its anonymous count remains. */
class AssessmentAggregateCoverage
{
    /**
     *
     * @var string $asOf
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('as_of')]
    public string $asOf;

    /**
     *
     * @var string $firstAnswersStartedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('first_answers_started_at')]
    public string $firstAnswersStartedAt;

    /**
     *
     * @var string $scoreOutcomesStartedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('score_outcomes_started_at')]
    public string $scoreOutcomesStartedAt;

    /**
     *
     * @var string $retainedFrom
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('retained_from')]
    public string $retainedFrom;

    /**
     * first_answers uses anonymous counters that can include erased detail. retained_first_answers computes exact intersections over retained first answers within 31 days. Requests exceeding the 100000-record work budget are refused.
     *
     * @var \NoResponse\Models\Shared\Population|string $population
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('population')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Population|string')]
    public Population|string $population;

    /**
     *
     * @var bool $erasedRecordsIncluded
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('erased_records_included')]
    public bool $erasedRecordsIncluded;

    /**
     *
     * @var bool $overlappingGroups
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('overlapping_groups')]
    public bool $overlappingGroups;

    /**
     *
     * @var string $lateFlipUnit
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('late_flip_unit')]
    public string $lateFlipUnit;

    /**
     *
     * @var bool $historicalBackfill
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('historical_backfill')]
    public bool $historicalBackfill;

    /**
     * @param  string  $asOf
     * @param  string  $firstAnswersStartedAt
     * @param  string  $scoreOutcomesStartedAt
     * @param  string  $retainedFrom
     * @param  \NoResponse\Models\Shared\Population|string  $population
     * @param  bool  $erasedRecordsIncluded
     * @param  bool  $overlappingGroups
     * @param  string  $lateFlipUnit
     * @param  bool  $historicalBackfill
     * @phpstan-pure
     */
    public function __construct(string $asOf, string $firstAnswersStartedAt, string $scoreOutcomesStartedAt, string $retainedFrom, Population|string $population, bool $erasedRecordsIncluded, bool $overlappingGroups, string $lateFlipUnit = 'decision_transitions', bool $historicalBackfill = false)
    {
        $this->asOf = $asOf;
        $this->firstAnswersStartedAt = $firstAnswersStartedAt;
        $this->scoreOutcomesStartedAt = $scoreOutcomesStartedAt;
        $this->retainedFrom = $retainedFrom;
        $this->population = $population;
        $this->erasedRecordsIncluded = $erasedRecordsIncluded;
        $this->overlappingGroups = $overlappingGroups;
        $this->lateFlipUnit = $lateFlipUnit;
        $this->historicalBackfill = $historicalBackfill;
    }
}