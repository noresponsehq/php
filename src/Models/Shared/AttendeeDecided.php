<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AttendeeDecided - A reviewer recorded a decision on an attendee. The decision's note stays in the API. Sent once per recorded review; an attendee's latest review is its decision, so order by decided_at. */
class AttendeeDecided
{
    /**
     * The attendee's event.
     *
     * @var string $eventId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('event_id')]
    public string $eventId;

    /**
     * The attendee decided on.
     *
     * @var string $attendeeId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attendee_id')]
    public string $attendeeId;

    /**
     * The recorded review.
     *
     * @var string $reviewId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('review_id')]
    public string $reviewId;

    /**
     *
     * @var \NoResponse\Models\Shared\AttendeeDecision|string $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttendeeDecision|string')]
    public AttendeeDecision|string $decision;

    /**
     * Who decided: the member's external user id, or the API key's label, as the attendee's decided_by.
     *
     * @var string $decidedBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decided_by')]
    public string $decidedBy;

    /**
     * When the decision was recorded; equal to the event's created_at.
     *
     * @var string $decidedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decided_at')]
    public string $decidedAt;

    /**
     * @param  string  $eventId
     * @param  string  $attendeeId
     * @param  string  $reviewId
     * @param  \NoResponse\Models\Shared\AttendeeDecision|string  $decision
     * @param  string  $decidedBy
     * @param  string  $decidedAt
     * @phpstan-pure
     */
    public function __construct(string $eventId, string $attendeeId, string $reviewId, AttendeeDecision|string $decision, string $decidedBy, string $decidedAt)
    {
        $this->eventId = $eventId;
        $this->attendeeId = $attendeeId;
        $this->reviewId = $reviewId;
        $this->decision = $decision;
        $this->decidedBy = $decidedBy;
        $this->decidedAt = $decidedAt;
    }
}