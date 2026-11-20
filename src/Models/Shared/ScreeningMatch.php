<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningMatch - How a profile was matched to the person: the state its evidence earns, and the evidence. */
class ScreeningMatch
{
    /**
     * How sure the screening is that a profile is the person's, from the likelihood its record scores. Confirmed reaches the join bar of 0.9. Probable reaches 0.85, which takes a shared value beyond the one that found the account. Possible is the rest.
     *
     * @var \NoResponse\Models\Shared\ProfileMatchState|string $state
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('state')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ProfileMatchState|string')]
    public ProfileMatchState|string $state;

    /**
     * $evidence
     *
     * @var array<\NoResponse\Models\Shared\ScreeningMatchEvidence> $evidence
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evidence')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningMatchEvidence>')]
    public array $evidence;

    /**
     * @param  \NoResponse\Models\Shared\ProfileMatchState|string  $state
     * @param  array<\NoResponse\Models\Shared\ScreeningMatchEvidence>  $evidence
     * @phpstan-pure
     */
    public function __construct(ProfileMatchState|string $state, array $evidence)
    {
        $this->state = $state;
        $this->evidence = $evidence;
    }
}