<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PolicyPreviewCoverage
{
    /**
     *
     * @var int $scanned
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('scanned')]
    public int $scanned;

    /**
     *
     * @var int $eligible
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('eligible')]
    public int $eligible;

    /**
     *
     * @var int $missingScore
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('missing_score')]
    public int $missingScore;

    /**
     *
     * @var int $unsupported
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('unsupported')]
    public int $unsupported;

    /**
     *
     * @var bool $truncated
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('truncated')]
    public bool $truncated;

    /**
     *
     * @var bool $completeRetainedWindow
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('complete_retained_window')]
    public bool $completeRetainedWindow;

    /**
     * Deleted, expired and uncaptured records cannot be reconstructed. Counts describe retained evidence and provide no causal estimate of fraud prevented.
     *
     * @var bool $historicalPopulationKnown
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('historical_population_known')]
    public bool $historicalPopulationKnown;

    /**
     * @param  int  $scanned
     * @param  int  $eligible
     * @param  int  $missingScore
     * @param  int  $unsupported
     * @param  bool  $truncated
     * @param  bool  $completeRetainedWindow
     * @param  bool  $historicalPopulationKnown
     * @phpstan-pure
     */
    public function __construct(int $scanned, int $eligible, int $missingScore, int $unsupported, bool $truncated, bool $completeRetainedWindow, bool $historicalPopulationKnown = false)
    {
        $this->scanned = $scanned;
        $this->eligible = $eligible;
        $this->missingScore = $missingScore;
        $this->unsupported = $unsupported;
        $this->truncated = $truncated;
        $this->completeRetainedWindow = $completeRetainedWindow;
        $this->historicalPopulationKnown = $historicalPopulationKnown;
    }
}