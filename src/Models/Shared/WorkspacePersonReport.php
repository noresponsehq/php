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
     * Accounts the person is known to hold, at most 20.
     *
     * @var ?array<\NoResponse\Models\Shared\Handle> $handles
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('handles')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Handle>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $handles = null;

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
     * Every search on this person's values, newest first, whether a person started it or enrichment did: each names the value, the record and field it came from, and the search that found that record. Absent when nothing was searched.
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
     * The most recent retained completed or partial investigation, or a migrated result whose original per-person status is unknown. The evidence below belongs to this investigation. Read investigation history for earlier results and pending jobs.
     *
     * @var ?\NoResponse\Models\Shared\Investigation $evidenceInvestigation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evidence_investigation')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Investigation|null')]
    public ?Investigation $evidenceInvestigation;

    /**
     * An investigator's profile of this person, written from the evidence of a settled investigation. Null until an investigation completes or partially completes, and null when evidence.read is denied.
     *
     * @var ?\NoResponse\Models\Shared\WrittenProfile $writtenProfile
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('written_profile')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\WrittenProfile|null')]
    public ?WrittenProfile $writtenProfile;

    /**
     * @param  string  $id
     * @param  string  $createdAt
     * @param  string  $updatedAt
     * @param  string  $expiresAt
     * @param  array<\NoResponse\Models\Shared\ScreeningProfile>  $profiles
     * @param  array<\NoResponse\Models\Shared\ScreeningFinding>  $findings
     * @param  array<\NoResponse\Models\Shared\ScreeningPost>  $posts
     * @param  array<\NoResponse\Models\Shared\ScreeningMedia>  $media
     * @param  ?string  $externalId
     * @param  ?string  $name
     * @param  ?string  $email
     * @param  ?string  $phone
     * @param  ?string  $company
     * @param  ?string  $city
     * @param  ?array<\NoResponse\Models\Shared\Handle>  $handles
     * @param  ?\NoResponse\Models\Shared\ScreeningLookup  $lookup
     * @param  ?array<\NoResponse\Models\Shared\Search>  $searches
     * @param  ?bool  $evidenceRestricted
     * @param  ?\NoResponse\Models\Shared\Investigation  $evidenceInvestigation
     * @param  ?\NoResponse\Models\Shared\WrittenProfile  $writtenProfile
     * @phpstan-pure
     */
    public function __construct(string $id, string $createdAt, string $updatedAt, string $expiresAt, array $profiles, array $findings, array $posts, array $media, ?string $externalId = null, ?string $name = null, ?string $email = null, ?string $phone = null, ?string $company = null, ?string $city = null, ?array $handles = null, ?ScreeningLookup $lookup = null, ?array $searches = null, ?bool $evidenceRestricted = null, ?Investigation $evidenceInvestigation = null, ?WrittenProfile $writtenProfile = null)
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->expiresAt = $expiresAt;
        $this->profiles = $profiles;
        $this->findings = $findings;
        $this->posts = $posts;
        $this->media = $media;
        $this->externalId = $externalId;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->company = $company;
        $this->city = $city;
        $this->handles = $handles;
        $this->lookup = $lookup;
        $this->searches = $searches;
        $this->evidenceRestricted = $evidenceRestricted;
        $this->evidenceInvestigation = $evidenceInvestigation;
        $this->writtenProfile = $writtenProfile;
    }
}