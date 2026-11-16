<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PersonReport - Everything known about one person, and where else in the environment they appear. */
class PersonReport
{
    /**
     * A person and where their screening and review stand.
     *
     * @var \NoResponse\Models\Shared\Person $person
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('person')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Person')]
    public Person $person;

    /**
     * The accounts this result matched, with how each was matched.
     *
     * @var array<\NoResponse\Models\Shared\ScreeningProfile> $profiles
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('profiles')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningProfile>')]
    public array $profiles;

    /**
     * What this result flagged, most severe first, each citing its evidence.
     *
     * @var array<\NoResponse\Models\Shared\ScreeningFinding> $findings
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('findings')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningFinding>')]
    public array $findings;

    /**
     * All posts retained for this result, including posts that no finding cites.
     *
     * @var array<\NoResponse\Models\Shared\ScreeningPost> $posts
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('posts')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningPost>')]
    public array $posts;

    /**
     * All images and videos retained for this result, including media that no finding cites.
     *
     * @var array<\NoResponse\Models\Shared\ScreeningMedia> $media
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('media')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningMedia>')]
    public array $media;

    /**
     * Every recorded decision, oldest first.
     *
     * @var array<\NoResponse\Models\Shared\PersonReview> $reviews
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reviews')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\PersonReview>')]
    public array $reviews;

    /**
     * Where else in the environment the person appears, read live from those groups: deleting one removes it here.
     *
     * @var \NoResponse\Models\Shared\OtherGroups $otherGroups
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('other_groups')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\OtherGroups')]
    public OtherGroups $otherGroups;

    /**
     * What the signup check's lookups found for a person: account presence for the email, phone and usernames (the person's handles), the phone lookup, the email domain's registration and the breach search. Context and coverage for the reviewer, not a finding: nothing here sets a band or a match state.
     *
     * @var ?\NoResponse\Models\Shared\ScreeningLookup $lookup
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('lookup')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningLookup|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?ScreeningLookup $lookup = null;

    /**
     * The searches on this person's values in this group, newest first: each names the value, the record and field it came from, and the search that found that record. Absent when nothing was searched.
     *
     * @var ?array<\NoResponse\Models\Shared\Search> $searches
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('searches')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Search>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $searches = null;

    /**
     * True when evidence.read is explicitly denied. Submitted details, coverage, job status and decisions remain available. Collected records, profiles, findings, posts, media, discovered values and free-text decision notes are withheld.
     *
     * @var ?bool $evidenceRestricted
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evidence_restricted')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $evidenceRestricted = null;

    /**
     * @param  \NoResponse\Models\Shared\Person  $person
     * @param  array<\NoResponse\Models\Shared\ScreeningProfile>  $profiles
     * @param  array<\NoResponse\Models\Shared\ScreeningFinding>  $findings
     * @param  array<\NoResponse\Models\Shared\ScreeningPost>  $posts
     * @param  array<\NoResponse\Models\Shared\ScreeningMedia>  $media
     * @param  array<\NoResponse\Models\Shared\PersonReview>  $reviews
     * @param  \NoResponse\Models\Shared\OtherGroups  $otherGroups
     * @param  ?\NoResponse\Models\Shared\ScreeningLookup  $lookup
     * @param  ?array<\NoResponse\Models\Shared\Search>  $searches
     * @param  ?bool  $evidenceRestricted
     * @phpstan-pure
     */
    public function __construct(Person $person, array $profiles, array $findings, array $posts, array $media, array $reviews, OtherGroups $otherGroups, ?ScreeningLookup $lookup = null, ?array $searches = null, ?bool $evidenceRestricted = null)
    {
        $this->person = $person;
        $this->profiles = $profiles;
        $this->findings = $findings;
        $this->posts = $posts;
        $this->media = $media;
        $this->reviews = $reviews;
        $this->otherGroups = $otherGroups;
        $this->lookup = $lookup;
        $this->searches = $searches;
        $this->evidenceRestricted = $evidenceRestricted;
    }
}