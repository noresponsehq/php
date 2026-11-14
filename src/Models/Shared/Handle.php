<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Handle - An account the person is known to hold. */
class Handle
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
     * The account's handle, without a leading @.
     *
     * @var string $handle
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('handle')]
    public string $handle;

    /**
     * @param  \NoResponse\Models\Shared\HandlePlatform|string  $platform
     * @param  string  $handle
     * @phpstan-pure
     */
    public function __construct(HandlePlatform|string $platform, string $handle)
    {
        $this->platform = $platform;
        $this->handle = $handle;
    }
}