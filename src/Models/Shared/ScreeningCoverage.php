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
     * Items read that the analyser could not analyse. Above zero, the attendee is partial: a finding may be missing from them.
     *
     * @var ?int $itemsNotAnalysed
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items_not_analysed')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $itemsNotAnalysed = null;

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
     * Requested platforms where the attendee gave the screening nothing to look up, such as no handle for a platform that reads supplied handles only. Nothing looked and nothing failed: such a platform is not in platforms, is not none_found and does not make the attendee partial.
     *
     * @var array<\NoResponse\Models\Shared\HandlePlatform|string>|null $notSearched
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('not_searched')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\HandlePlatform|string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $notSearched = null;

    /**
     * @param  int  $accountsFound
     * @param  int  $accountsAccessible
     * @param  int  $itemsRead
     * @param  array<\NoResponse\Models\Shared\ScreeningPlatformCoverage>  $platforms
     * @param  ?int  $itemsNotAnalysed
     * @param  ?string  $periodFrom
     * @param  ?string  $periodTo
     * @param  array<\NoResponse\Models\Shared\HandlePlatform|string>|null  $notSearched
     * @phpstan-pure
     */
    public function __construct(int $accountsFound, int $accountsAccessible, int $itemsRead, array $platforms, ?int $itemsNotAnalysed = null, ?string $periodFrom = null, ?string $periodTo = null, ?array $notSearched = null)
    {
        $this->accountsFound = $accountsFound;
        $this->accountsAccessible = $accountsAccessible;
        $this->itemsRead = $itemsRead;
        $this->platforms = $platforms;
        $this->itemsNotAnalysed = $itemsNotAnalysed;
        $this->periodFrom = $periodFrom;
        $this->periodTo = $periodTo;
        $this->notSearched = $notSearched;
    }
}