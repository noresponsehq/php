<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AttendeeFlagged - A screening recorded a finding on an attendee. It says which attendee and how severe, not what they posted, who they are or why: GET the attendee report for the findings. Sent once per screening that flags the attendee, so a re-screen of someone on watch announces them again. */
class AttendeeFlagged
{
    /**
     * The attendee's event.
     *
     * @var string $eventId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('event_id')]
    public string $eventId;

    /**
     * The flagged attendee.
     *
     * @var string $attendeeId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attendee_id')]
    public string $attendeeId;

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
     * How sure the screening is that the accounts it read are the attendee's. A finding on a possible match is at most moderate, on a probable match at most high.
     *
     * @var \NoResponse\Models\Shared\AttendeeFlaggedMatchState $matchState
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('match_state')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttendeeFlaggedMatchState')]
    public AttendeeFlaggedMatchState $matchState;

    /**
     * When the screening recorded the finding; equal to the event's created_at.
     *
     * @var string $flaggedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flagged_at')]
    public string $flaggedAt;

    /**
     * @param  string  $eventId
     * @param  string  $attendeeId
     * @param  string  $screeningId
     * @param  \NoResponse\Models\Shared\HighestBand|string  $highestBand
     * @param  \NoResponse\Models\Shared\AttendeeFlaggedMatchState  $matchState
     * @param  string  $flaggedAt
     * @phpstan-pure
     */
    public function __construct(string $eventId, string $attendeeId, string $screeningId, HighestBand|string $highestBand, AttendeeFlaggedMatchState $matchState, string $flaggedAt)
    {
        $this->eventId = $eventId;
        $this->attendeeId = $attendeeId;
        $this->screeningId = $screeningId;
        $this->highestBand = $highestBand;
        $this->matchState = $matchState;
        $this->flaggedAt = $flaggedAt;
    }
}