<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RiskCoverage - Counts of planned source-identifier pairs by evidence outcome, deduplicated across signals and incomplete entries. These counts do not measure identity agreement or prove that processing is still running. A lane that was not searched is not an answered source. */
class RiskCoverage
{
    /**
     * Source-identifier pairs that gave a definite found or not_found answer.
     *
     * @var int $answered
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('answered')]
    public int $answered;

    /**
     * Source-identifier pairs that could not answer, including unsupported coverage markers and source failures. Read detailed signals to distinguish Not covered from Failed.
     *
     * @var int $failed
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('failed')]
    public int $failed;

    /**
     * Source-identifier pairs with deferred or timed_out evidence. A terminal timeout can remain here after processing finishes; use assessment status and continuation metadata to determine whether work is still running.
     *
     * @var int $pending
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('pending')]
    public int $pending;

    /**
     * @param  int  $answered
     * @param  int  $failed
     * @param  int  $pending
     * @phpstan-pure
     */
    public function __construct(int $answered, int $failed, int $pending)
    {
        $this->answered = $answered;
        $this->failed = $failed;
        $this->pending = $pending;
    }
}