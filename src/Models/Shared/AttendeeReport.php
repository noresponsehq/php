<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AttendeeReport - Everything known about one attendee. */
class AttendeeReport
{
    /**
     * An attendee and where their screening and review stand.
     *
     * @var \NoResponse\Models\Shared\Attendee $attendee
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attendee')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Attendee')]
    public Attendee $attendee;

    /**
     * The accounts the screening matched, with how each was matched.
     *
     * @var array<\NoResponse\Models\Shared\Profile> $profiles
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('profiles')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Profile>')]
    public array $profiles;

    /**
     * What the screening flagged, with its evidence.
     *
     * @var array<\NoResponse\Models\Shared\Finding> $findings
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('findings')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Finding>')]
    public array $findings;

    /**
     * Every recorded decision, oldest first.
     *
     * @var array<\NoResponse\Models\Shared\AttendeeReview> $reviews
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reviews')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AttendeeReview>')]
    public array $reviews;

    /**
     * @param  \NoResponse\Models\Shared\Attendee  $attendee
     * @param  array<\NoResponse\Models\Shared\Profile>  $profiles
     * @param  array<\NoResponse\Models\Shared\Finding>  $findings
     * @param  array<\NoResponse\Models\Shared\AttendeeReview>  $reviews
     * @phpstan-pure
     */
    public function __construct(Attendee $attendee, array $profiles, array $findings, array $reviews)
    {
        $this->attendee = $attendee;
        $this->profiles = $profiles;
        $this->findings = $findings;
        $this->reviews = $reviews;
    }
}