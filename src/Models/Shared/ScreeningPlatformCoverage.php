<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningPlatformCoverage - What a screening read on one platform. */
class ScreeningPlatformCoverage
{
    /**
     * A platform a screening can cover. synthetic is the deterministic connector's own platform, for exercising the product end to end with no network.
     *
     * @var \NoResponse\Models\Shared\HandlePlatform|string $platform
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('platform')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\HandlePlatform|string')]
    public HandlePlatform|string $platform;

    /**
     * covered read at least one profile; none_found looked and found no account; inaccessible found accounts that are private or locked; failed could not finish looking; unavailable has no resolver or collector enabled.
     *
     * @var \NoResponse\Models\Shared\ScreeningPlatformCoverageStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningPlatformCoverageStatus|string')]
    public ScreeningPlatformCoverageStatus|string $status;

    /**
     *
     * @var int $accountsFound
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('accounts_found')]
    public int $accountsFound;

    /**
     *
     * @var int $itemsRead
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items_read')]
    public int $itemsRead;

    /**
     * @param  \NoResponse\Models\Shared\HandlePlatform|string  $platform
     * @param  \NoResponse\Models\Shared\ScreeningPlatformCoverageStatus|string  $status
     * @param  int  $accountsFound
     * @param  int  $itemsRead
     * @phpstan-pure
     */
    public function __construct(HandlePlatform|string $platform, ScreeningPlatformCoverageStatus|string $status, int $accountsFound, int $itemsRead)
    {
        $this->platform = $platform;
        $this->status = $status;
        $this->accountsFound = $accountsFound;
        $this->itemsRead = $itemsRead;
    }
}