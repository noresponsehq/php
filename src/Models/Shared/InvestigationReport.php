<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** InvestigationReport - Read an investigation and its evidence. */
class InvestigationReport
{
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
     *
     * @var \NoResponse\Models\Shared\WorkspacePerson $person
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('person')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\WorkspacePerson')]
    public WorkspacePerson $person;

    /**
     *
     * @var \NoResponse\Models\Shared\Investigation $investigation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('investigation')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Investigation')]
    public Investigation $investigation;

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
     * True when evidence.read is explicitly denied. Submitted details, coverage, job status and decisions remain available. Collected records, profiles, findings, posts, media, discovered values and free-text decision notes are withheld.
     *
     * @var ?bool $evidenceRestricted
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evidence_restricted')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $evidenceRestricted = null;

    /**
     * @param  array<\NoResponse\Models\Shared\ScreeningProfile>  $profiles
     * @param  array<\NoResponse\Models\Shared\ScreeningFinding>  $findings
     * @param  array<\NoResponse\Models\Shared\ScreeningPost>  $posts
     * @param  array<\NoResponse\Models\Shared\ScreeningMedia>  $media
     * @param  array<\NoResponse\Models\Shared\PersonReview>  $reviews
     * @param  \NoResponse\Models\Shared\WorkspacePerson  $person
     * @param  \NoResponse\Models\Shared\Investigation  $investigation
     * @param  ?\NoResponse\Models\Shared\ScreeningLookup  $lookup
     * @param  ?bool  $evidenceRestricted
     * @phpstan-pure
     */
    public function __construct(array $profiles, array $findings, array $posts, array $media, array $reviews, WorkspacePerson $person, Investigation $investigation, ?ScreeningLookup $lookup = null, ?bool $evidenceRestricted = null)
    {
        $this->profiles = $profiles;
        $this->findings = $findings;
        $this->posts = $posts;
        $this->media = $media;
        $this->reviews = $reviews;
        $this->person = $person;
        $this->investigation = $investigation;
        $this->lookup = $lookup;
        $this->evidenceRestricted = $evidenceRestricted;
    }
}