<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RiskCoverage - Sources counted by state, not named. */
class RiskCoverage
{
    /**
     * Sources that gave a definite answer.
     *
     * @var int $answered
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('answered')]
    public int $answered;

    /**
     * Sources that could not answer.
     *
     * @var int $failed
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('failed')]
    public int $failed;

    /**
     * Sources still being asked.
     *
     * @var int $pending
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('pending')]
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