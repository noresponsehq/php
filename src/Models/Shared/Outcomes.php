<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Outcomes - Accounts whose current completed assessment was created in the selected window and remains retained at as_of. The effective account feedback head is observed at as_of, including explicit unknown reports. Customer-reported labels and unlabelled accounts have separate counts. Superseded labels are excluded. */
class Outcomes
{
    /**
     *
     * @var int $denominator
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('denominator')]
    public int $denominator;

    /**
     *
     * @var int $reported
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reported')]
    public int $reported;

    /**
     *
     * @var int $unreported
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('unreported')]
    public int $unreported;

    /**
     * Counts only; a zero denominator means no eligible retained records and does not imply a zero rate.
     *
     * @var \NoResponse\Models\Shared\Coverage $labelCoverage
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('label_coverage')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Coverage')]
    public Coverage $labelCoverage;

    /**
     * Current customer-reported labels, not independently established ground truth. Missing keys mean zero. Unknown is an explicit report; absent or expired feedback is unreported.
     *
     * @var \NoResponse\Models\Shared\OutcomesByOutcome $byOutcome
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('by_outcome')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\OutcomesByOutcome')]
    public OutcomesByOutcome $byOutcome;

    /**
     *
     * @var string $population
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('population')]
    public string $population;

    /**
     * @param  string  $population
     * @param  int  $denominator
     * @param  int  $reported
     * @param  int  $unreported
     * @param  \NoResponse\Models\Shared\Coverage  $labelCoverage
     * @param  \NoResponse\Models\Shared\OutcomesByOutcome  $byOutcome
     * @phpstan-pure
     */
    public function __construct(int $denominator, int $reported, int $unreported, Coverage $labelCoverage, OutcomesByOutcome $byOutcome, string $population = 'retained_current_accounts_by_current_assessment_created_at')
    {
        $this->denominator = $denominator;
        $this->reported = $reported;
        $this->unreported = $unreported;
        $this->labelCoverage = $labelCoverage;
        $this->byOutcome = $byOutcome;
        $this->population = $population;
    }
}