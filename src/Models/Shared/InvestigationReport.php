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
     * All posts retained for this result.
     *
     * @var array<\NoResponse\Models\Shared\ScreeningPost> $posts
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('posts')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningPost>')]
    public array $posts;

    /**
     * All images and videos retained for this result.
     *
     * @var array<\NoResponse\Models\Shared\ScreeningMedia> $media
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('media')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningMedia>')]
    public array $media;

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
     * What the signup check's lookups found for a person: account presence for the email, phone and usernames (the person's handles), the phone lookup, the email domain's registration and the breach search. Nothing here sets a match state.
     *
     * @var ?\NoResponse\Models\Shared\ScreeningLookup $lookup
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('lookup')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningLookup|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?ScreeningLookup $lookup = null;

    /**
     * True when evidence.read is explicitly denied. Submitted details, coverage and job status remain available. Collected records, profiles, posts, media and discovered values are withheld.
     *
     * @var ?bool $evidenceRestricted
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evidence_restricted')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $evidenceRestricted = null;

    /**
     * @param  array<\NoResponse\Models\Shared\ScreeningProfile>  $profiles
     * @param  array<\NoResponse\Models\Shared\ScreeningPost>  $posts
     * @param  array<\NoResponse\Models\Shared\ScreeningMedia>  $media
     * @param  \NoResponse\Models\Shared\WorkspacePerson  $person
     * @param  \NoResponse\Models\Shared\Investigation  $investigation
     * @param  ?\NoResponse\Models\Shared\ScreeningLookup  $lookup
     * @param  ?bool  $evidenceRestricted
     * @phpstan-pure
     */
    public function __construct(array $profiles, array $posts, array $media, WorkspacePerson $person, Investigation $investigation, ?ScreeningLookup $lookup = null, ?bool $evidenceRestricted = null)
    {
        $this->profiles = $profiles;
        $this->posts = $posts;
        $this->media = $media;
        $this->person = $person;
        $this->investigation = $investigation;
        $this->lookup = $lookup;
        $this->evidenceRestricted = $evidenceRestricted;
    }
}