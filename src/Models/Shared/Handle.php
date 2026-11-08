<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Handle - An account the attendee is known to hold. */
class Handle
{
    /**
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