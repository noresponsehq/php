<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Enforcements - Retained customer enforcement report rows created in [from,to), one row per account/risk_version/flow/action. A later applied report can replace failed at the original created_at; retries are not additional attempts here. applied_coverage divides reported_applied by report rows, including explicit action none; it is not independently verified execution, all requested actions, or prevented fraud. Unreported actions are unknown. */
class Enforcements
{
    /**
     *
     * @var int $denominator
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('denominator')]
    public int $denominator;

    /**
     *
     * @var int $accounts
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('accounts')]
    public int $accounts;

    /**
     *
     * @var int $reportedApplied
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reported_applied')]
    public int $reportedApplied;

    /**
     *
     * @var int $reportedFailed
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reported_failed')]
    public int $reportedFailed;

    /**
     * Counts only; a zero denominator means no eligible retained records and does not imply a zero rate.
     *
     * @var \NoResponse\Models\Shared\Coverage $appliedCoverage
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('applied_coverage')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Coverage')]
    public Coverage $appliedCoverage;

    /**
     *
     * @var string $population
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('population')]
    public string $population;

    /**
     * @param  string  $population
     * @param  int  $denominator
     * @param  int  $accounts
     * @param  int  $reportedApplied
     * @param  int  $reportedFailed
     * @param  \NoResponse\Models\Shared\Coverage  $appliedCoverage
     * @phpstan-pure
     */
    public function __construct(int $denominator, int $accounts, int $reportedApplied, int $reportedFailed, Coverage $appliedCoverage, string $population = 'retained_enforcement_reports_by_created_at')
    {
        $this->denominator = $denominator;
        $this->accounts = $accounts;
        $this->reportedApplied = $reportedApplied;
        $this->reportedFailed = $reportedFailed;
        $this->appliedCoverage = $appliedCoverage;
        $this->population = $population;
    }
}