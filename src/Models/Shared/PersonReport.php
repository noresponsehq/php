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
     * Every recorded decision, oldest first.
     *
     * @var array<\NoResponse\Models\Shared\PersonReview> $reviews
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reviews')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\PersonReview>')]
    public array $reviews;

    /**
     * The searches enrichment would start on this person in this group, likeliest record first. Group screening follows the environment's enrichment setting, with suggest as its mode while the workspace has not set one. In off mode the list is empty. In suggest mode enrichment starts none of them by itself; in automatic mode it starts them as its limits allow. Empty when evidence.read is denied.
     *
     * @var array<\NoResponse\Models\Shared\SuggestedSearch> $suggestedSearches
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('suggested_searches')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\SuggestedSearch>')]
    public array $suggestedSearches;

    /**
     * Where else in the environment the person appears, read live from those groups: deleting one removes it here.
     *
     * @var \NoResponse\Models\Shared\OtherGroups $otherGroups
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('other_groups')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\OtherGroups')]
    public OtherGroups $otherGroups;

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
     * The searches on this person's values in this group, newest first: each names the value, the record and field it came from, and the search that found that record. Absent when nothing was searched.
     *
     * @var ?array<\NoResponse\Models\Shared\Search> $searches
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('searches')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Search>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $searches = null;

    /**
     * True when evidence.read is explicitly denied. Submitted details, coverage, job status and decisions remain available. Collected records, profiles, posts, media, discovered values and free-text decision notes are withheld.
     *
     * @var ?bool $evidenceRestricted
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evidence_restricted')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $evidenceRestricted = null;

    /**
     * @param  \NoResponse\Models\Shared\Person  $person
     * @param  array<\NoResponse\Models\Shared\ScreeningProfile>  $profiles
     * @param  array<\NoResponse\Models\Shared\ScreeningPost>  $posts
     * @param  array<\NoResponse\Models\Shared\ScreeningMedia>  $media
     * @param  array<\NoResponse\Models\Shared\PersonReview>  $reviews
     * @param  array<\NoResponse\Models\Shared\SuggestedSearch>  $suggestedSearches
     * @param  \NoResponse\Models\Shared\OtherGroups  $otherGroups
     * @param  ?\NoResponse\Models\Shared\ScreeningLookup  $lookup
     * @param  ?array<\NoResponse\Models\Shared\Search>  $searches
     * @param  ?bool  $evidenceRestricted
     * @phpstan-pure
     */
    public function __construct(Person $person, array $profiles, array $posts, array $media, array $reviews, array $suggestedSearches, OtherGroups $otherGroups, ?ScreeningLookup $lookup = null, ?array $searches = null, ?bool $evidenceRestricted = null)
    {
        $this->person = $person;
        $this->profiles = $profiles;
        $this->posts = $posts;
        $this->media = $media;
        $this->reviews = $reviews;
        $this->suggestedSearches = $suggestedSearches;
        $this->otherGroups = $otherGroups;
        $this->lookup = $lookup;
        $this->searches = $searches;
        $this->evidenceRestricted = $evidenceRestricted;
    }
}