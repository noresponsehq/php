<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Handle - An account the person is known to hold. */
class Handle
{
    /**
     * A platform a screening can cover, such as instagram, x, bluesky, youtube, tiktok or github. The screening registry owns the set: a request that names a platform it does not cover answers 422. A new platform adds an id without changing this contract, so read a platform you do not know in a response as one you have not seen before, not as an error. synthetic is the deterministic connector's own platform, for exercising the product end to end with no network.
     *
     * @var string $platform
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('platform')]
    public string $platform;

    /**
     * The account's handle, without a leading @.
     *
     * @var string $handle
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('handle')]
    public string $handle;

    /**
     * @param  string  $platform
     * @param  string  $handle
     * @phpstan-pure
     */
    public function __construct(string $platform, string $handle)
    {
        $this->platform = $platform;
        $this->handle = $handle;
    }
}