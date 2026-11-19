<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningPlatformCoverage - What a screening read on one platform. */
class ScreeningPlatformCoverage
{
    /**
     * A platform a screening can cover, such as instagram, x, bluesky, youtube, tiktok or github. The screening registry owns the set: a request that names a platform it does not cover answers 422. A new platform adds an id without changing this contract, so read a platform you do not know in a response as one you have not seen before, not as an error. synthetic is the deterministic connector's own platform, for exercising the product end to end with no network.
     *
     * @var string $platform
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('platform')]
    public string $platform;

    /**
     * covered read at least one profile; none_found looked and found no account; inaccessible found accounts that are private or locked; failed could not finish looking; unavailable has no resolver or collector enabled.
     *
     * @var \NoResponse\Models\Shared\ScreeningPlatformCoverageStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningPlatformCoverageStatus|string')]
    public ScreeningPlatformCoverageStatus|string $status;

    /**
     * Accounts found on the platform: at most 5, the best candidates the search kept.
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
     * @param  string  $platform
     * @param  \NoResponse\Models\Shared\ScreeningPlatformCoverageStatus|string  $status
     * @param  int  $accountsFound
     * @param  int  $itemsRead
     * @phpstan-pure
     */
    public function __construct(string $platform, ScreeningPlatformCoverageStatus|string $status, int $accountsFound, int $itemsRead)
    {
        $this->platform = $platform;
        $this->status = $status;
        $this->accountsFound = $accountsFound;
        $this->itemsRead = $itemsRead;
    }
}