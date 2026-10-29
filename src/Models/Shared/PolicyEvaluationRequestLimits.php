<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PolicyEvaluationRequestLimits
{
    /**
     *
     * @var float $reviewRate
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('review_rate')]
    public float $reviewRate;

    /**
     *
     * @var float $serverErrorRate
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('server_error_rate')]
    public float $serverErrorRate;

    /**
     *
     * @var float $unavailableResultRate
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('unavailable_result_rate')]
    public float $unavailableResultRate;

    /**
     *
     * @var float $p95Ms
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('p95_ms')]
    public float $p95Ms;

    /**
     * @param  float  $reviewRate
     * @param  float  $serverErrorRate
     * @param  float  $unavailableResultRate
     * @param  float  $p95Ms
     * @phpstan-pure
     */
    public function __construct(float $reviewRate, float $serverErrorRate, float $unavailableResultRate, float $p95Ms)
    {
        $this->reviewRate = $reviewRate;
        $this->serverErrorRate = $serverErrorRate;
        $this->unavailableResultRate = $unavailableResultRate;
        $this->p95Ms = $p95Ms;
    }
}