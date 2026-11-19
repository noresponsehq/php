<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningCoverageTiming - How long this search's latest attempt took, stage by stage. started_at minus the investigation's creation is the time spent queued or retrying. */
class ScreeningCoverageTiming
{
    /**
     * When the attempt that wrote this result started.
     *
     * @var string $startedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('started_at')]
    public string $startedAt;

    /**
     * Milliseconds from started_at to the end of the last stage listed.
     *
     * @var int $totalMs
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('total_ms')]
    public int $totalMs;

    /**
     * Stages finished so far, in order. The result first written lists stages up to written; the settled result lists them all.
     *
     * @var array<\NoResponse\Models\Shared\StageTime> $stages
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('stages')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\StageTime>')]
    public array $stages;

    /**
     * @param  string  $startedAt
     * @param  int  $totalMs
     * @param  array<\NoResponse\Models\Shared\StageTime>  $stages
     * @phpstan-pure
     */
    public function __construct(string $startedAt, int $totalMs, array $stages)
    {
        $this->startedAt = $startedAt;
        $this->totalMs = $totalMs;
        $this->stages = $stages;
    }
}