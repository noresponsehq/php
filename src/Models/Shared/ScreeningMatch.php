<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningMatch - How a profile was matched to the attendee: the state its evidence earns, and the evidence. */
class ScreeningMatch
{
    /**
     * How sure the screening is that a profile is the attendee's, from its evidence: confirmed is a handle on the attendee row, or two or more hard identifiers (email, phone, a supplied handle, or a fact an existing source returned); probable is one identifier beyond the name; possible is the name alone.
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