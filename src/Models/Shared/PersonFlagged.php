<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PersonFlagged - A screening recorded a finding on a person. It says which person and how severe, not what they posted, who they are or why: GET the person report for the findings. Sent once per screening that flags the person, so a re-screen of someone on watch announces them again. */
class PersonFlagged
{
    /**
     * The person's group.
     *
     * @var string $groupId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('group_id')]
    public string $groupId;

    /**
     * The flagged person.
     *
     * @var string $personId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('person_id')]
    public string $personId;

    /**
     * The screening that flagged them.
     *
     * @var string $screeningId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('screening_id')]
    public string $screeningId;

    /**
     *
     * @var \NoResponse\Models\Shared\HighestBand|string $highestBand
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('highest_band')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\HighestBand|string')]
    public HighestBand|string $highestBand;

    /**
     * How sure the screening is that the accounts it read are the person's. A finding on a possible match is at most moderate, on a probable match at most high.
     *
     * @var \NoResponse\Models\Shared\PersonFlaggedMatchState $matchState
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('match_state')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PersonFlaggedMatchState')]
    public PersonFlaggedMatchState $matchState;

    /**
     * When the screening recorded the finding; equal to the event's created_at.
     *
     * @var string $flaggedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flagged_at')]
    public string $flaggedAt;

    /**
     * @param  string  $groupId
     * @param  string  $personId
     * @param  string  $screeningId
     * @param  \NoResponse\Models\Shared\HighestBand|string  $highestBand
     * @param  \NoResponse\Models\Shared\PersonFlaggedMatchState  $matchState
     * @param  string  $flaggedAt
     * @phpstan-pure
     */
    public function __construct(string $groupId, string $personId, string $screeningId, HighestBand|string $highestBand, PersonFlaggedMatchState $matchState, string $flaggedAt)
    {
        $this->groupId = $groupId;
        $this->personId = $personId;
        $this->screeningId = $screeningId;
        $this->highestBand = $highestBand;
        $this->matchState = $matchState;
        $this->flaggedAt = $flaggedAt;
    }
}