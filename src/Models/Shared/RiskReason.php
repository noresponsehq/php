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
    #[\NoResponse\Serializer\Annotation\SerializedName('code')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReasonCode')]
    public ReasonCode $code;

    /**
     *
     * @var int $weight
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('weight')]
    public int $weight;

    /**
     * The submitted identifier or client context field a reason concerns; absent when it concerns the whole assessment. Client context is a claimed hint, not a device fingerprint.
     *
     * @var ?\NoResponse\Models\Shared\ReasonIdentifier $identifier
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('identifier')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReasonIdentifier|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
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