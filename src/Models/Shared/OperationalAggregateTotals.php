<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class OperationalAggregateTotals
{
    /**
     *
     * @var int $attempts
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attempts')]
    public int $attempts;

    /**
     *
     * @var int $succeeded
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('succeeded')]
    public int $succeeded;

    /**
     *
     * @var int $failed
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('failed')]
    public int $failed;

    /**
     *
     * @var int $clientErrors
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('client_errors')]
    public int $clientErrors;

    /**
     *
     * @var int $serverErrors
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('server_errors')]
    public int $serverErrors;

    /**
     *
     * @var int $replays
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('replays')]
    public int $replays;

    /**
     *
     * @var int $incompleteWrites
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('incomplete_writes')]
    public int $incompleteWrites;

    /**
     *
     * @var int $unattributedKeys
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('unattributed_keys')]
    public int $unattributedKeys;

    /**
     * Continuous percentile over retained attempts. Omitted when there are no captured samples.
     *
     * @var ?float $p50Ms
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('p50_ms')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?float $p50Ms = null;

    /**
     * Continuous percentile over retained attempts. Omitted when there are no captured samples.
     *
     * @var ?float $p95Ms
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('p95_ms')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?float $p95Ms = null;

    /**
     * Continuous percentile over retained attempts. Omitted when there are no captured samples.
     *
     * @var ?float $p99Ms
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('p99_ms')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?float $p99Ms = null;

    /**
     * @param  int  $attempts
     * @param  int  $succeeded
     * @param  int  $failed
     * @param  int  $clientErrors
     * @param  int  $serverErrors
     * @param  int  $replays
     * @param  int  $incompleteWrites
     * @param  int  $unattributedKeys
     * @param  ?float  $p50Ms
     * @param  ?float  $p95Ms
     * @param  ?float  $p99Ms
     * @phpstan-pure
     */
    public function __construct(int $attempts, int $succeeded, int $failed, int $clientErrors, int $serverErrors, int $replays, int $incompleteWrites, int $unattributedKeys, ?float $p50Ms = null, ?float $p95Ms = null, ?float $p99Ms = null)
    {
        $this->attempts = $attempts;
        $this->succeeded = $succeeded;
        $this->failed = $failed;
        $this->clientErrors = $clientErrors;
        $this->serverErrors = $serverErrors;
        $this->replays = $replays;
        $this->incompleteWrites = $incompleteWrites;
        $this->unattributedKeys = $unattributedKeys;
        $this->p50Ms = $p50Ms;
        $this->p95Ms = $p95Ms;
        $this->p99Ms = $p99Ms;
    }
}