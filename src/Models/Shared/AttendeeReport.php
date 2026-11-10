<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AttendeeReport - Everything known about one attendee, and where else in the environment they appear. */
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
     * The accounts the latest screening matched, with how each was matched.
     *
     * @var array<\NoResponse\Models\Shared\ScreeningProfile> $profiles
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('profiles')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningProfile>')]
    public array $profiles;

    /**
     * What the latest screening flagged, most severe first, each citing its evidence.
     *
     * @var array<\NoResponse\Models\Shared\ScreeningFinding> $findings
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('findings')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningFinding>')]
    public array $findings;

    /**
     * The posts the findings cite.
     *
     * @var array<\NoResponse\Models\Shared\ScreeningPost> $posts
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('posts')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningPost>')]
    public array $posts;

    /**
     * The images and videos the findings cite.
     *
     * @var array<\NoResponse\Models\Shared\ScreeningMedia> $media
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('media')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningMedia>')]
    public array $media;

    /**
     * Every recorded decision, oldest first.
     *
     * @var array<\NoResponse\Models\Shared\AttendeeReview> $reviews
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reviews')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AttendeeReview>')]
    public array $reviews;

    /**
     * Where else in the environment the attendee appears, read live from those events: deleting one removes it here.
     *
     * @var \NoResponse\Models\Shared\OtherEvents $otherEvents
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('other_events')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\OtherEvents')]
    public OtherEvents $otherEvents;

    /**
     * @param  \NoResponse\Models\Shared\Attendee  $attendee
     * @param  array<\NoResponse\Models\Shared\ScreeningProfile>  $profiles
     * @param  array<\NoResponse\Models\Shared\ScreeningFinding>  $findings
     * @param  array<\NoResponse\Models\Shared\ScreeningPost>  $posts
     * @param  array<\NoResponse\Models\Shared\ScreeningMedia>  $media
     * @param  array<\NoResponse\Models\Shared\AttendeeReview>  $reviews
     * @param  \NoResponse\Models\Shared\OtherEvents  $otherEvents
     * @phpstan-pure
     */
    public function __construct(Attendee $attendee, array $profiles, array $findings, array $posts, array $media, array $reviews, OtherEvents $otherEvents)
    {
        $this->attendee = $attendee;
        $this->profiles = $profiles;
        $this->findings = $findings;
        $this->posts = $posts;
        $this->media = $media;
        $this->reviews = $reviews;
        $this->otherEvents = $otherEvents;
    }
}