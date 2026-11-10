<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** OtherEvent - An attendee of another event in the same environment who shares an email or phone with this one, as that event recorded them. */
class OtherEvent
{
    /**
     *
     * @var string $eventId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('event_id')]
    public string $eventId;

    /**
     *
     * @var string $eventName
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('event_name')]
    public string $eventName;

    /**
     *
     * @var string $eventStartsAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('event_starts_at')]
    public string $eventStartsAt;

    /**
     * The attendee on that event's list.
     *
     * @var string $attendeeId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attendee_id')]
    public string $attendeeId;

    /**
     * Which identifiers match, in this order. external_id appears only beside email or phone: the same external id alone is not a match, since ticket numbers may be reused across events.
     *
     * @var array<\NoResponse\Models\Shared\MatchedOn|string> $matchedOn
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('matched_on')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\MatchedOn|string>')]
    public array $matchedOn;

    /**
     * How sure the latest screening is that it found the attendee's accounts. unscreened until a screening reaches the attendee.
     *
     * @var \NoResponse\Models\Shared\MatchState|string $matchState
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('match_state')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\MatchState|string')]
    public MatchState|string $matchState;

    /**
     * That attendee's most severe band at that event, or null.
     *
     * @var \NoResponse\Models\Shared\HighestBand|string|null $highestBand
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('highest_band')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\HighestBand|string|null')]
    public HighestBand|string|null $highestBand;

    /**
     * The latest reviewer decision at that event, or null before any.
     *
     * @var \NoResponse\Models\Shared\AttendeeDecision|string|null $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttendeeDecision|string|null')]
    public AttendeeDecision|string|null $decision;

    /**
     * Who made that decision.
     *
     * @var ?string $decidedBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decided_by')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $decidedBy = null;

    /**
     * When that decision was made.
     *
     * @var ?string $decidedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decided_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $decidedAt = null;

    /**
     * @param  string  $eventId
     * @param  string  $eventName
     * @param  string  $eventStartsAt
     * @param  string  $attendeeId
     * @param  array<\NoResponse\Models\Shared\MatchedOn|string>  $matchedOn
     * @param  \NoResponse\Models\Shared\MatchState|string  $matchState
     * @param  \NoResponse\Models\Shared\HighestBand|string|null  $highestBand
     * @param  \NoResponse\Models\Shared\AttendeeDecision|string|null  $decision
     * @param  ?string  $decidedBy
     * @param  ?string  $decidedAt
     * @phpstan-pure
     */
    public function __construct(string $eventId, string $eventName, string $eventStartsAt, string $attendeeId, array $matchedOn, MatchState|string $matchState, HighestBand|string|null $highestBand = null, AttendeeDecision|string|null $decision = null, ?string $decidedBy = null, ?string $decidedAt = null)
    {
        $this->eventId = $eventId;
        $this->eventName = $eventName;
        $this->eventStartsAt = $eventStartsAt;
        $this->attendeeId = $attendeeId;
        $this->matchedOn = $matchedOn;
        $this->matchState = $matchState;
        $this->highestBand = $highestBand;
        $this->decision = $decision;
        $this->decidedBy = $decidedBy;
        $this->decidedAt = $decidedAt;
    }
}