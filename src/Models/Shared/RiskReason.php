<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class RiskReason
{
    /**
     * A stable reason code. New codes may appear; ignore any you do not know.
     *
     * @var \NoResponse\Models\Shared\ReasonCode $code
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('code')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReasonCode')]
    public ReasonCode $code;

    /**
     *
     * @var int $weight
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('weight')]
    public int $weight;

    /**
     * The submitted identifier or client context field a reason concerns; absent when it concerns the whole assessment. Client context is a claimed hint, not a device fingerprint.
     *
     * @var ?\NoResponse\Models\Shared\ReasonIdentifier $identifier
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('identifier')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReasonIdentifier|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?ReasonIdentifier $identifier = null;

    /**
     * @param  \NoResponse\Models\Shared\ReasonCode  $code
     * @param  int  $weight
     * @param  ?\NoResponse\Models\Shared\ReasonIdentifier  $identifier
     * @phpstan-pure
     */
    public function __construct(ReasonCode $code, int $weight, ?ReasonIdentifier $identifier = null)
    {
        $this->code = $code;
        $this->weight = $weight;
        $this->identifier = $identifier;
    }
}