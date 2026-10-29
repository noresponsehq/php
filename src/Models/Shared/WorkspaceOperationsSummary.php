<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WorkspaceOperationsSummary - Three separately defined populations with independent denominators. Interpret each section within its own population; their totals do not form a conversion funnel. All counts and retention come from one snapshot. Requests above the population or query budget are refused without truncation. */
class WorkspaceOperationsSummary
{
    /**
     * The workspace id, which is also its live environment's workspace id; the test environment's is the same id with :test appended. A workspace created through the API is tnt_ and a 26-character ULID.
     *
     * @var string $workspaceId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('workspace_id')]
    public string $workspaceId;

    /**
     *
     * @var \NoResponse\Models\Shared\AuditSettingsEnvironment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AuditSettingsEnvironment|string')]
    public AuditSettingsEnvironment|string $environment;

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
     * @var string $asOf
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('as_of')]
    public string $asOf;

    /**
     *
     * @var string $retainedFrom
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('retained_from')]
    public string $retainedFrom;

    /**
     *
     * @var int $retentionDays
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('retention_days')]
    public int $retentionDays;

    /**
     *
     * @var int $recordsRead
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('records_read')]
    public int $recordsRead;

    /**
     * Accounts whose current completed assessment was created in the selected window and remains retained at as_of. The effective account feedback head is observed at as_of, including explicit unknown reports. Customer-reported labels and unlabelled accounts have separate counts. Superseded labels are excluded.
     *
     * @var \NoResponse\Models\Shared\Outcomes $outcomes
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('outcomes')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Outcomes')]
    public Outcomes $outcomes;

    /**
     * Retained customer enforcement report rows created in [from,to), one row per account/risk_version/flow/action. A later applied report can replace failed at the original created_at; retries are not additional attempts here. applied_coverage divides reported_applied by report rows, including explicit action none; it is not independently verified execution, all requested actions, or prevented fraud. Unreported actions are unknown.
     *
     * @var \NoResponse\Models\Shared\Enforcements $enforcements
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('enforcements')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Enforcements')]
    public Enforcements $enforcements;

    /**
     * Reviews created in [from,to) whose review and current account assessment remain retained. Status and assignment are current at as_of, not a transition history. label_coverage numerator is resolved reviews labeled benign or abuse; denominator is resolved reviews. Inconclusive is not a known outcome. Review conclusions do not change account feedback or enforcement.
     *
     * @var \NoResponse\Models\Shared\Reviews $reviews
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reviews')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Reviews')]
    public Reviews $reviews;

    /**
     *
     * @var int $rowBudget
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('row_budget')]
    public int $rowBudget;

    /**
     *
     * @var bool $truncated
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('truncated')]
    public bool $truncated;

    /**
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\AuditSettingsEnvironment|string  $environment
     * @param  string  $from
     * @param  string  $to
     * @param  string  $asOf
     * @param  string  $retainedFrom
     * @param  int  $retentionDays
     * @param  int  $rowBudget
     * @param  int  $recordsRead
     * @param  bool  $truncated
     * @param  \NoResponse\Models\Shared\Outcomes  $outcomes
     * @param  \NoResponse\Models\Shared\Enforcements  $enforcements
     * @param  \NoResponse\Models\Shared\Reviews  $reviews
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, AuditSettingsEnvironment|string $environment, string $from, string $to, string $asOf, string $retainedFrom, int $retentionDays, int $recordsRead, Outcomes $outcomes, Enforcements $enforcements, Reviews $reviews, int $rowBudget = 100000, bool $truncated = false)
    {
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
        $this->from = $from;
        $this->to = $to;
        $this->asOf = $asOf;
        $this->retainedFrom = $retainedFrom;
        $this->retentionDays = $retentionDays;
        $this->recordsRead = $recordsRead;
        $this->outcomes = $outcomes;
        $this->enforcements = $enforcements;
        $this->reviews = $reviews;
        $this->rowBudget = $rowBudget;
        $this->truncated = $truncated;
    }
}