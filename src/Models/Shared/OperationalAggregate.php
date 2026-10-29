<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** OperationalAggregate - One repeatable-read snapshot of retained request diagnostics or webhook attempts. Capture can have gaps and these counts are not a billing ledger. Unattributed keys include older requests and member requests. Queue state is current retained work, not a delivery success denominator. */
class OperationalAggregate
{
    /**
     *
     * @var \NoResponse\Models\Shared\Source|string $source
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('source')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Source|string')]
    public Source|string $source;

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
     * @var \NoResponse\Models\Shared\RequestAggregateRequestBucket|string $bucket
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('bucket')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RequestAggregateRequestBucket|string')]
    public RequestAggregateRequestBucket|string $bucket;

    /**
     *
     * @var \NoResponse\Models\Shared\OperationalAggregateTotals $totals
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('totals')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\OperationalAggregateTotals')]
    public OperationalAggregateTotals $totals;

    /**
     * Nonempty UTC buckets in ascending order. Counts include all retained matching attempts, without the log page limit.
     *
     * @var array<\NoResponse\Models\Shared\OperationalAggregateBucket> $buckets
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('buckets')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\OperationalAggregateBucket>')]
    public array $buckets;

    /**
     * Current retained delivery queue, independent of the requested attempt window and status filter. Endpoint filter applies. Does not prove customer enforcement execution.
     *
     * @var ?\NoResponse\Models\Shared\OperationalAggregateQueue $queue
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('queue')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\OperationalAggregateQueue|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?OperationalAggregateQueue $queue = null;

    /**
     *
     * @var string $schemaVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('schema_version')]
    public string $schemaVersion;

    /**
     *
     * @var string $capture
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('capture')]
    public string $capture;

    /**
     *
     * @var string $population
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('population')]
    public string $population;

    /**
     * @param  string  $schemaVersion
     * @param  \NoResponse\Models\Shared\Source|string  $source
     * @param  string  $from
     * @param  string  $to
     * @param  string  $asOf
     * @param  string  $retainedFrom
     * @param  int  $retentionDays
     * @param  \NoResponse\Models\Shared\RequestAggregateRequestBucket|string  $bucket
     * @param  string  $capture
     * @param  string  $population
     * @param  \NoResponse\Models\Shared\OperationalAggregateTotals  $totals
     * @param  array<\NoResponse\Models\Shared\OperationalAggregateBucket>  $buckets
     * @param  ?\NoResponse\Models\Shared\OperationalAggregateQueue  $queue
     * @phpstan-pure
     */
    public function __construct(Source|string $source, string $from, string $to, string $asOf, string $retainedFrom, int $retentionDays, RequestAggregateRequestBucket|string $bucket, OperationalAggregateTotals $totals, array $buckets, ?OperationalAggregateQueue $queue = null, string $schemaVersion = '1', string $capture = 'best_effort', string $population = 'retained_attempts')
    {
        $this->source = $source;
        $this->from = $from;
        $this->to = $to;
        $this->asOf = $asOf;
        $this->retainedFrom = $retainedFrom;
        $this->retentionDays = $retentionDays;
        $this->bucket = $bucket;
        $this->totals = $totals;
        $this->buckets = $buckets;
        $this->queue = $queue;
        $this->schemaVersion = $schemaVersion;
        $this->capture = $capture;
        $this->population = $population;
    }
}