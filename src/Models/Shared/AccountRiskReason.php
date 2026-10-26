<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountRiskReason - One reason that fired. direction is whether it raises or lowers the score, or is neutral (informational, it moves nothing). impact is a coarse band of how much it moves the score: none for a neutral reason, otherwise low, medium or high. */
class AccountRiskReason
{
    /**
     * A stable reason code. New codes may appear; ignore any you do not know.
     *
     * @var \NoResponse\Models\Shared\ReasonCode|string $code
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('code')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReasonCode|string')]
    public ReasonCode|string $code;

    /**
     *
     * @var \NoResponse\Models\Shared\Direction|string $direction
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('direction')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Direction|string')]
    public Direction|string $direction;

    /**
     *
     * @var \NoResponse\Models\Shared\Impact|string $impact
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('impact')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Impact|string')]
    public Impact|string $impact;

    /**
     * The submitted identifier or client context field a reason concerns; absent when it concerns the whole assessment. Client context is a claimed hint, not a device fingerprint.
     *
     * @var \NoResponse\Models\Shared\ReasonIdentifier|string|null $identifier
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('identifier')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReasonIdentifier|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ReasonIdentifier|string|null $identifier = null;

    /**
     * Deprecated and always 0: the policy's weights are not published. It is sent so that SDK versions that require it keep reading reasons. Read direction and impact.
     *
     * @var ?int $weight
     * @deprecated  field: This will be removed in a future release, please migrate away from it as soon as possible.
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('weight')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $weight = null;

    /**
     * @param  \NoResponse\Models\Shared\ReasonCode|string  $code
     * @param  \NoResponse\Models\Shared\Direction|string  $direction
     * @param  \NoResponse\Models\Shared\Impact|string  $impact
     * @param  \NoResponse\Models\Shared\ReasonIdentifier|string|null  $identifier
     * @param  ?int  $weight
     * @phpstan-pure
     */
    public function __construct(ReasonCode|string $code, Direction|string $direction, Impact|string $impact, ReasonIdentifier|string|null $identifier = null, ?int $weight = 0)
    {
        $this->code = $code;
        $this->direction = $direction;
        $this->impact = $impact;
        $this->identifier = $identifier;
        $this->weight = $weight;
    }
}