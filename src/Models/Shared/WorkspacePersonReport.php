<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WorkspacePersonReport - Read a workspace person. */
class WorkspacePersonReport
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var string $updatedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('updated_at')]
    public string $updatedAt;

    /**
     * The time the workspace retention policy removes this person, their evidence and investigation history. Shortening workspace retention can move this time earlier.
     *
     * @var string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    public string $expiresAt;

    /**
     * Every group this person belongs to in this environment, most recently added first, with their role in each. A person can belong to any number of groups; removing them from a group or deleting the group removes it here.
     *
     * @var array<\NoResponse\Models\Shared\PersonGroup> $groups
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('groups')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\PersonGroup>')]
    public array $groups;

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
     * The searches enrichment would start on this person, likeliest record first, under the environment's enrichment setting for a person's own investigation. In off mode the list is empty. In suggest mode enrichment starts none of them by itself; in automatic mode it starts them as its limits allow. Empty when evidence.read is denied.
     *
     * @var array<\NoResponse\Models\Shared\SuggestedSearch> $suggestedSearches
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('suggested_searches')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\SuggestedSearch>')]
    public array $suggestedSearches;

    /**
     * What changed between each settled investigation of this person and the one before it, unreviewed first, then most significant, then newest. The first investigation records no changes. When evidence.read is denied, before and after are withheld.
     *
     * @var array<\NoResponse\Models\Shared\PersonChange> $changes
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('changes')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\PersonChange>')]
    public array $changes;

    /**
     * The person's rerun schedule. Each due run starts a full investigation of the person, as POST /v1/investigations does, and its changes are stored as changes. The schedule lives in the database and the worker runs it, so it survives restarts and releases; each due run starts exactly one investigation.
     *
     * @var \NoResponse\Models\Shared\PersonSchedule $schedule
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('schedule')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PersonSchedule')]
    public PersonSchedule $schedule;

    /**
     * Your reference for this person within the workspace environment. Only an explicit reference or person_id can reuse an existing person.
     *
     * @var ?string $externalId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('external_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $externalId = null;

    /**
     *
     * @var ?string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $name = null;

    /**
     * The person's email.
     *
     * @var ?string $email
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('email')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $email = null;

    /**
     * The person's phone in E.164 form.
     *
     * @var ?string $phone
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('phone')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $phone = null;

    /**
     * Where the person works.
     *
     * @var ?string $company
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('company')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $company = null;

    /**
     * Where the person lives.
     *
     * @var ?string $city
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('city')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $city = null;

    /**
     * A username the person uses, with no platform. A search looks it up on every platform that finds accounts by username.
     *
     * @var ?string $username
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('username')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $username = null;

    /**
     * Accounts the person is known to hold, at most 20.
     *
     * @var ?array<\NoResponse\Models\Shared\Handle> $handles
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('handles')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Handle>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $handles = null;

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
     * Every search on this person's values, newest first, whether a person started it or enrichment did: each names the value, the record and field it came from, and the search that found that record. Absent when nothing was searched.
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
     * The most recent retained completed or partial investigation, or a migrated result whose original per-person status is unknown. The evidence below belongs to this investigation. Read investigation history for earlier results and pending jobs.
     *
     * @var ?\NoResponse\Models\Shared\Investigation $evidenceInvestigation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evidence_investigation')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Investigation|null')]
    public ?Investigation $evidenceInvestigation;

    /**
     * @param  string  $id
     * @param  string  $createdAt
     * @param  string  $updatedAt
     * @param  string  $expiresAt
     * @param  array<\NoResponse\Models\Shared\PersonGroup>  $groups
     * @param  array<\NoResponse\Models\Shared\ScreeningProfile>  $profiles
     * @param  array<\NoResponse\Models\Shared\ScreeningPost>  $posts
     * @param  array<\NoResponse\Models\Shared\ScreeningMedia>  $media
     * @param  array<\NoResponse\Models\Shared\SuggestedSearch>  $suggestedSearches
     * @param  array<\NoResponse\Models\Shared\PersonChange>  $changes
     * @param  \NoResponse\Models\Shared\PersonSchedule  $schedule
     * @param  ?string  $externalId
     * @param  ?string  $name
     * @param  ?string  $email
     * @param  ?string  $phone
     * @param  ?string  $company
     * @param  ?string  $city
     * @param  ?string  $username
     * @param  ?array<\NoResponse\Models\Shared\Handle>  $handles
     * @param  ?\NoResponse\Models\Shared\ScreeningLookup  $lookup
     * @param  ?array<\NoResponse\Models\Shared\Search>  $searches
     * @param  ?bool  $evidenceRestricted
     * @param  ?\NoResponse\Models\Shared\Investigation  $evidenceInvestigation
     * @phpstan-pure
     */
    public function __construct(string $id, string $createdAt, string $updatedAt, string $expiresAt, array $groups, array $profiles, array $posts, array $media, array $suggestedSearches, array $changes, PersonSchedule $schedule, ?string $externalId = null, ?string $name = null, ?string $email = null, ?string $phone = null, ?string $company = null, ?string $city = null, ?string $username = null, ?array $handles = null, ?ScreeningLookup $lookup = null, ?array $searches = null, ?bool $evidenceRestricted = null, ?Investigation $evidenceInvestigation = null)
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->expiresAt = $expiresAt;
        $this->groups = $groups;
        $this->profiles = $profiles;
        $this->posts = $posts;
        $this->media = $media;
        $this->suggestedSearches = $suggestedSearches;
        $this->changes = $changes;
        $this->schedule = $schedule;
        $this->externalId = $externalId;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->company = $company;
        $this->city = $city;
        $this->username = $username;
        $this->handles = $handles;
        $this->lookup = $lookup;
        $this->searches = $searches;
        $this->evidenceRestricted = $evidenceRestricted;
        $this->evidenceInvestigation = $evidenceInvestigation;
    }
}