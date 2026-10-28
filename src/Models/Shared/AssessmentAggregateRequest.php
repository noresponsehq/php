<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentAggregateRequest - Count this environment's assessments created in [from,to) by bucket, from counts kept as each assessment is first answered, not by scanning assessments. Each assessment counts once, by its first answer (the answer served when it was first answered); later revisions and late results do not count it again, and late_flips counts its later account decision changes. from and to start a bucket (an hour, a UTC day, or a week from Monday 00:00 UTC), cover at most 366 days (31 for hour buckets) and from is inside the retention period. The filters are POST /v1/assessments/search's and describe the first answer, so a cell drills down to search with the same filters, revision first and the cell's bucket as from and to. Counts hold no identifier and stay when an assessment or account is deleted or erased; they expire with retention and go with the workspace. Reasons are counted by code and impact band, not by weight. No Idempotency-Key. */
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
     * At most two dimensions to count by, of which at most one is reason, lane, country or asn. An assessment counts once in each of its reasons and incomplete lanes, so those groups can add up to more than the bucket's count.
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
     * @phpstan-pure
     */
    public function __construct(string $from, string $to, Bucket|string $bucket, ?array $groupBy = null, ?array $metrics = null, Flow|string|null $flow = null, Status|string|null $status = null, Recommendation|string|null $recommendation = null, Decision|string|null $decision = null, ?AnswerRevision $revision = null, ?int $limit = 20)
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
        $this->limit = $limit;
    }
}