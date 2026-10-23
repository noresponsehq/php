<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** KeyRotationRequest - POST /v1/keys/rotate body. The workspace and the key being rotated are the API key that signs the request, so neither is a body member. An empty object takes the default overlap. */
class KeyRotationRequest
{
    /**
     * How long the presented key keeps working beside the new one, from 60 seconds to 7 days. Default 86400 (24 hours). At the end of the overlap the presented key stops authenticating.
     *
     * @var ?int $overlapSeconds
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('overlap_seconds')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $overlapSeconds = null;

    /**
     * @param  ?int  $overlapSeconds
     * @phpstan-pure
     */
    public function __construct(?int $overlapSeconds = null)
    {
        $this->overlapSeconds = $overlapSeconds;
    }
}