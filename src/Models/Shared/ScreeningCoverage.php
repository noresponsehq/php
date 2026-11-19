<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningCoverage - The denominator of a screening: accounts found, how many could be read, items read and the period they span, so a clean result is distinct from a person nobody could see. */
class ScreeningCoverage
{
    /**
     *
     * @var int $accountsFound
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('accounts_found')]
    public int $accountsFound;

    /**
     *
     * @var int $accountsAccessible
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('accounts_accessible')]
    public int $accountsAccessible;

    /**
     *
     * @var int $itemsRead
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items_read')]
    public int $itemsRead;

    /**
     * $platforms
     *
     * @var array<\NoResponse\Models\Shared\ScreeningPlatformCoverage> $platforms
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('platforms')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningPlatformCoverage>')]
    public array $platforms;

    /**
     * Items read that the analyser could not analyse. Above zero, the person is partial: a finding may be missing from them.
     *
     * @var ?int $itemsNotAnalysed
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items_not_analysed')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $itemsNotAnalysed = null;

    /**
     * items_not_analysed split by reason, each reason once with at least one item.
     *
     * @var ?array<\NoResponse\Models\Shared\ScreeningNotAnalysedCount> $notAnalysedByReason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('not_analysed_by_reason')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningNotAnalysedCount>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $notAnalysedByReason = null;

    /**
     * Videos the analyser read from their cover frame and caption alone, without their sound or later frames. They count as analysed and do not make the person partial. Left out when none.
     *
     * @var ?int $itemsFrameOnly
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items_frame_only')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $itemsFrameOnly = null;

    /**
     * The oldest item read on any platform.
     *
     * @var ?string $periodFrom
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('period_from')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $periodFrom = null;

    /**
     * The newest item read on any platform.
     *
     * @var ?string $periodTo
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('period_to')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $periodTo = null;

    /**
     * Requested platforms where the person gave the screening nothing to look up, such as no handle for a platform that reads supplied handles only. Nothing looked and nothing failed: such a platform is not in platforms, is not none_found and does not make the person partial.
     *
     * @var ?array<string> $notSearched
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('not_searched')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $notSearched = null;

    /**
     * How many sources this search asked and how many answered, across the lookup stage (sources asked whether an account exists for an identifier) and the platform stage (profiles read on each platform). A source that answered may have found nothing; one that did not answer failed or ran out of time.
     *
     * @var ?\NoResponse\Models\Shared\ScreeningCoverageSources $sources
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('sources')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningCoverageSources|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?ScreeningCoverageSources $sources = null;

    /**
     * How long this search's latest attempt took, stage by stage. started_at minus the investigation's creation is the time spent queued or retrying.
     *
     * @var ?\NoResponse\Models\Shared\ScreeningCoverageTiming $timing
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('timing')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningCoverageTiming|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?ScreeningCoverageTiming $timing = null;

    /**
     * @param  int  $accountsFound
     * @param  int  $accountsAccessible
     * @param  int  $itemsRead
     * @param  array<\NoResponse\Models\Shared\ScreeningPlatformCoverage>  $platforms
     * @param  ?int  $itemsNotAnalysed
     * @param  ?array<\NoResponse\Models\Shared\ScreeningNotAnalysedCount>  $notAnalysedByReason
     * @param  ?int  $itemsFrameOnly
     * @param  ?string  $periodFrom
     * @param  ?string  $periodTo
     * @param  ?array<string>  $notSearched
     * @param  ?\NoResponse\Models\Shared\ScreeningCoverageSources  $sources
     * @param  ?\NoResponse\Models\Shared\ScreeningCoverageTiming  $timing
     * @phpstan-pure
     */
    public function __construct(int $accountsFound, int $accountsAccessible, int $itemsRead, array $platforms, ?int $itemsNotAnalysed = null, ?array $notAnalysedByReason = null, ?int $itemsFrameOnly = null, ?string $periodFrom = null, ?string $periodTo = null, ?array $notSearched = null, ?ScreeningCoverageSources $sources = null, ?ScreeningCoverageTiming $timing = null)
    {
        $this->accountsFound = $accountsFound;
        $this->accountsAccessible = $accountsAccessible;
        $this->itemsRead = $itemsRead;
        $this->platforms = $platforms;
        $this->itemsNotAnalysed = $itemsNotAnalysed;
        $this->notAnalysedByReason = $notAnalysedByReason;
        $this->itemsFrameOnly = $itemsFrameOnly;
        $this->periodFrom = $periodFrom;
        $this->periodTo = $periodTo;
        $this->notSearched = $notSearched;
        $this->sources = $sources;
        $this->timing = $timing;
    }
}