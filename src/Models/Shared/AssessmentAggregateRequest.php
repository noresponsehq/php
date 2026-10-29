<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentAggregateRequest - Count this environment's assessments created in [from,to) by bucket, from counts kept as each assessment is first answered, not by scanning assessments. Each assessment counts once, by its first answer (the answer served when it was first answered); later revisions and late results do not count it again, and late_flips counts its later account decision changes. from and to start a bucket (an hour, a UTC day, or a week from Monday 00:00 UTC), cover at most 366 days (31 for hour buckets) and from is inside the retention period. The filters are POST /v1/assessments/search's and describe the first answer, so a cell drills down to search with the same filters, revision first and the cell's bucket as from and to. Counts hold no identifier and stay when an assessment or account is deleted or erased; they expire with retention and go with the workspace. Reasons are counted by code and impact band, not by weight. No Idempotency-Key. Select retained_first_answers for exact facet filters and pairs over retained detail. This mode supports count, score_histogram and score_outcomes, and refuses late_flips. It has a 31-day and 100000-record work budget. */
class AssessmentAggregateRequest
{
    /**
     * The first bucket's start.
     *
     * @var string $from
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('from')]
    public string $from;

    /**
     * The end, excluded: the start of the bucket after the last.
     *
     * @var string $to
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('to')]
    public string $to;

    /**
     * The period each count covers, in UTC; a week starts on Monday.
     *
     * @var \NoResponse\Models\Shared\Bucket|string $bucket
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('bucket')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Bucket|string')]
    public Bucket|string $bucket;

    /**
     * At most two dimensions to count by, of which at most one is reason, lane, country or asn. An assessment counts once in each of its reasons and incomplete lanes, so those groups can add up to more than the bucket's count. With population retained_first_answers, both dimensions can be facets; counts cover retained first answers only.
     *
     * @var array<\NoResponse\Models\Shared\AggregateDimension|string>|null $groupBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('group_by')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AggregateDimension|string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $groupBy = null;

    /**
     * count: each bucket's count and groups. score_histogram: first answers by flow and 5-point score bucket. score_outcomes: the histogram's first answers that have a reported outcome, by flow, 5-point score bucket and the latest outcome reported for the assessment (POST /v1/assessments/{assessment_id}/outcomes); the rest of a bin has none reported. late_flips: changes of an assessment's account decision for its flow after its first answer, by from, to and delay.
     *
     * @var ?array<\NoResponse\Models\Shared\AssessmentAggregateRequestMetric> $metrics
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('metrics')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AssessmentAggregateRequestMetric>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $metrics = null;

    /**
     * The event an assessment is made for: account_creation (a user creates an account), login (a user returns to an existing account) or purchase (a payment or a credit grant). The account's risk is reported with the decision for this flow.
     *
     * @var \NoResponse\Models\Shared\Flow|string|null $flow
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flow')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Flow|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Flow|string|null $flow = null;

    /**
     * complete: final; nothing is still running. A lane that failed or missed its 10 s deadline stays listed in incomplete_sources, and confidence is lower. partial: a recommendation exists and at least one lane is still running or did not settle (see incomplete_sources). pending: nothing usable before the deadline; no recommendation yet, poll or wait for the webhook.
     *
     * @var \NoResponse\Models\Shared\Status|string|null $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Status|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Status|string|null $status = null;

    /**
     * The recommended action: allow, step_up or review. Your application applies it.
     *
     * @var \NoResponse\Models\Shared\Recommendation|string|null $recommendation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('recommendation')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Recommendation|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Recommendation|string|null $recommendation = null;

    /**
     * An assessment's own decision: block when its stored risk.block is true, otherwise its recommendation. It is not the account's decision or held-admission state.
     *
     * @var \NoResponse\Models\Shared\Decision|string|null $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Decision|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Decision|string|null $decision = null;

    /**
     * Which answer of each assessment the filters describe: latest, the latest stored revision, or first, the first answer, as served when the assessment was first answered (POST /v1/assessments/aggregate counts first answers). A cell of an aggregate drills down to POST /v1/assessments/search with the same filters, revision first and the cell's bucket as from and to.
     *
     * @var ?\NoResponse\Models\Shared\AnswerRevision $revision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('revision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AnswerRevision|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AnswerRevision $revision = null;

    /**
     * first_answers uses anonymous counters that can include erased detail. retained_first_answers computes exact intersections over retained first answers within 31 days. Requests exceeding the 100000-record work budget are refused.
     *
     * @var \NoResponse\Models\Shared\Population|string|null $population
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('population')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Population|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Population|string|null $population = null;

    /**
     *
     * @var \NoResponse\Models\Shared\Band|string|null $band
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('band')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Band|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Band|string|null $band = null;

    /**
     * A stable reason code. New codes may appear; ignore any you do not know.
     *
     * @var \NoResponse\Models\Shared\ReasonCode|string|null $reason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reason')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReasonCode|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ReasonCode|string|null $reason = null;

    /**
     * The selected reason's served impact band. Requires reason.
     *
     * @var \NoResponse\Models\Shared\Impact|string|null $impact
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('impact')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Impact|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Impact|string|null $impact = null;

    /**
     * An evidence lane: accounts (account presence for email and username), phone, breach, domain (the email domain's registration) and ip.
     *
     * @var \NoResponse\Models\Shared\Lane|string|null $lane
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('lane')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Lane|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Lane|string|null $lane = null;

    /**
     *
     * @var ?string $country
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('country')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $country = null;

    /**
     *
     * @var ?int $asn
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('asn')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $asn = null;

    /**
     * Inclusive lower score bound. Pending answers without a score do not match.
     *
     * @var ?int $scoreMin
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('score_min')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $scoreMin = null;

    /**
     * Inclusive upper score bound, at least score_min when both are supplied.
     *
     * @var ?int $scoreMax
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('score_max')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $scoreMax = null;

    /**
     * The list action captured at the first answer. Requires revision first. Older answers without captured list state do not match, including none.
     *
     * @var ?\NoResponse\Models\Shared\ListMatch $listMatch
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('list_match')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ListMatch|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?ListMatch $listMatch = null;

    /**
     * The most groups answered: the largest over the whole range, then by value. groups_truncated says when there were more.
     *
     * @var ?int $limit
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('limit')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $limit = null;

    /**
     * @param  string  $from
     * @param  string  $to
     * @param  \NoResponse\Models\Shared\Bucket|string  $bucket
     * @param  array<\NoResponse\Models\Shared\AggregateDimension|string>|null  $groupBy
     * @param  ?array<\NoResponse\Models\Shared\AssessmentAggregateRequestMetric>  $metrics
     * @param  ?int  $limit
     * @param  \NoResponse\Models\Shared\Flow|string|null  $flow
     * @param  \NoResponse\Models\Shared\Status|string|null  $status
     * @param  \NoResponse\Models\Shared\Recommendation|string|null  $recommendation
     * @param  \NoResponse\Models\Shared\Decision|string|null  $decision
     * @param  ?\NoResponse\Models\Shared\AnswerRevision  $revision
     * @param  \NoResponse\Models\Shared\Population|string|null  $population
     * @param  \NoResponse\Models\Shared\Band|string|null  $band
     * @param  \NoResponse\Models\Shared\ReasonCode|string|null  $reason
     * @param  \NoResponse\Models\Shared\Impact|string|null  $impact
     * @param  \NoResponse\Models\Shared\Lane|string|null  $lane
     * @param  ?string  $country
     * @param  ?int  $asn
     * @param  ?int  $scoreMin
     * @param  ?int  $scoreMax
     * @param  ?\NoResponse\Models\Shared\ListMatch  $listMatch
     * @phpstan-pure
     */
    public function __construct(string $from, string $to, Bucket|string $bucket, ?array $groupBy = null, ?array $metrics = null, Flow|string|null $flow = null, Status|string|null $status = null, Recommendation|string|null $recommendation = null, Decision|string|null $decision = null, ?AnswerRevision $revision = null, Population|string|null $population = null, Band|string|null $band = null, ReasonCode|string|null $reason = null, Impact|string|null $impact = null, Lane|string|null $lane = null, ?string $country = null, ?int $asn = null, ?int $scoreMin = null, ?int $scoreMax = null, ?ListMatch $listMatch = null, ?int $limit = 20)
    {
        $this->from = $from;
        $this->to = $to;
        $this->bucket = $bucket;
        $this->groupBy = $groupBy;
        $this->metrics = $metrics;
        $this->flow = $flow;
        $this->status = $status;
        $this->recommendation = $recommendation;
        $this->decision = $decision;
        $this->revision = $revision;
        $this->population = $population;
        $this->band = $band;
        $this->reason = $reason;
        $this->impact = $impact;
        $this->lane = $lane;
        $this->country = $country;
        $this->asn = $asn;
        $this->scoreMin = $scoreMin;
        $this->scoreMax = $scoreMax;
        $this->listMatch = $listMatch;
        $this->limit = $limit;
    }
}