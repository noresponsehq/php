<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentAggregate - Body of the 200 answer to POST /v1/assessments/aggregate: one entry per bucket of [from,to), empty buckets included. Counts are of first answers and stay when an assessment or account is deleted or erased; search returns only assessments still retained. */
class AssessmentAggregate
{
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
     * The period each count covers, in UTC; a week starts on Monday.
     *
     * @var \NoResponse\Models\Shared\Bucket|string $bucket
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('bucket')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Bucket|string')]
    public Bucket|string $bucket;

    /**
     * $groupBy
     *
     * @var array<\NoResponse\Models\Shared\AggregateDimension|string> $groupBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('group_by')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AggregateDimension|string>')]
    public array $groupBy;

    /**
     * $metrics
     *
     * @var array<\NoResponse\Models\Shared\AssessmentAggregateMetric|string> $metrics
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('metrics')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AssessmentAggregateMetric|string>')]
    public array $metrics;

    /**
     * true when more groups had counts than limit allowed.
     *
     * @var bool $groupsTruncated
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('groups_truncated')]
    public bool $groupsTruncated;

    /**
     * $buckets
     *
     * @var array<\NoResponse\Models\Shared\AggregateBucket> $buckets
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('buckets')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AggregateBucket>')]
    public array $buckets;

    /**
     * Captured in the same database snapshot as the counts. Capture start times describe when counting began, not the earliest creation time counted: an older assessment may first answer later. Older outcomes are not inferred to be absent. Erased detail cannot be returned by drill-down even while its anonymous count remains.
     *
     * @var ?\NoResponse\Models\Shared\AssessmentAggregateCoverage $coverage
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('coverage')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssessmentAggregateCoverage|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AssessmentAggregateCoverage $coverage = null;

    /**
     * Version of the body shape.
     *
     * @var string $schemaVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('schema_version')]
    public string $schemaVersion;

    /**
     * The calling workspace's configured retention period in days. Default 365 (12 months), which is also the maximum: a workspace may only shorten it, to at least 1 day. Each record expires from its own created_at; see assessment expires_at.
     *
     * @var ?int $retentionDays
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('retention_days')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $retentionDays = null;

    /**
     * @param  string  $schemaVersion
     * @param  string  $from
     * @param  string  $to
     * @param  \NoResponse\Models\Shared\Bucket|string  $bucket
     * @param  array<\NoResponse\Models\Shared\AggregateDimension|string>  $groupBy
     * @param  array<\NoResponse\Models\Shared\AssessmentAggregateMetric|string>  $metrics
     * @param  bool  $groupsTruncated
     * @param  array<\NoResponse\Models\Shared\AggregateBucket>  $buckets
     * @param  ?int  $retentionDays
     * @param  ?\NoResponse\Models\Shared\AssessmentAggregateCoverage  $coverage
     * @phpstan-pure
     */
    public function __construct(string $from, string $to, Bucket|string $bucket, array $groupBy, array $metrics, bool $groupsTruncated, array $buckets, ?AssessmentAggregateCoverage $coverage = null, string $schemaVersion = '1', ?int $retentionDays = 365)
    {
        $this->from = $from;
        $this->to = $to;
        $this->bucket = $bucket;
        $this->groupBy = $groupBy;
        $this->metrics = $metrics;
        $this->groupsTruncated = $groupsTruncated;
        $this->buckets = $buckets;
        $this->coverage = $coverage;
        $this->schemaVersion = $schemaVersion;
        $this->retentionDays = $retentionDays;
    }
}