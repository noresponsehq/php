<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AttendeeBatchRequest - Adds or updates 1 to 500 attendees. A row naming an existing attendee of the event (the same external_id, else the same email, else the same phone) updates it. */
class AttendeeBatchRequest
{
    /**
     * $attendees
     *
     * @var array<\NoResponse\Models\Shared\AttendeeIdentity> $attendees
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attendees')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AttendeeIdentity>')]
    public array $attendees;

    /**
     * @param  array<\NoResponse\Models\Shared\AttendeeIdentity>  $attendees
     * @phpstan-pure
     */
    public function __construct(array $attendees)
    {
        $this->attendees = $attendees;
    }
}