<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Attendee - An attendee and where their screening and review stand. */
class Attendee
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var string $eventId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('event_id')]
    public string $eventId;

    /**
     * The attendee's full name.
     *
     * @var string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    public string $name;

    /**
     * How sure the latest screening is that it found the attendee's accounts. unscreened until a screening reaches the attendee, and after one that had no profile to check (no_profile_to_check).
     *
     * @var \NoResponse\Models\Shared\MatchState|string $matchState
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('match_state')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\MatchState|string')]
    public MatchState|string $matchState;

    /**
     * The denominator of a screening: accounts found, how many could be read, items read and the period they span, so a clean result is distinct from a person nobody could see.
     *
     * @var \NoResponse\Models\Shared\ScreeningCoverage $coverage
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('coverage')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningCoverage')]
    public ScreeningCoverage $coverage;

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
     * What screening cost, in US cents, in total and per implementation.
     *
     * @var \NoResponse\Models\Shared\ScreeningSpend $spend
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('spend')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningSpend')]
    public ScreeningSpend $spend;

    /**
     * Your own id for the attendee, unique within the event. A later row with the same external id updates this attendee.
     *
     * @var ?string $externalId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('external_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $externalId = null;

    /**
     * The attendee's email.
     *
     * @var ?string $email
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('email')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $email = null;

    /**
     * The attendee's phone in E.164 form.
     *
     * @var ?string $phone
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('phone')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $phone = null;

    /**
     * Where the attendee works.
     *
     * @var ?string $company
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('company')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $company = null;

    /**
     * Where the attendee lives.
     *
     * @var ?string $city
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('city')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $city = null;

    /**
     * Accounts the attendee is known to hold, at most 20.
     *
     * @var ?array<\NoResponse\Models\Shared\Handle> $handles
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('handles')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Handle>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $handles = null;

    /**
     * The attendee's role at the event: guest (a ticket holder), crew, vendor or press. Leave it out when you do not know it: an attendee without one has no role, not guest. A later row naming the same attendee replaces it, and a change of role alone keeps the attendee's screening results.
     *
     * @var \NoResponse\Models\Shared\AttendeeRole|string|null $role
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('role')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttendeeRole|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public AttendeeRole|string|null $role = null;

    /**
     * true when the latest screening reached the attendee but the list gave nothing to look up on any requested platform, such as no handle for a platform that reads supplied handles only: nobody looked for a profile. match_state stays unscreened, every platform is in coverage.not_searched, and the attendee is neither none_found nor failed and does not make the screening partial. Its lookups are on its report. Left out otherwise.
     *
     * @var ?bool $noProfileToCheck
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('no_profile_to_check')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $noProfileToCheck = null;

    /**
     * The most severe finding's band, or null when nothing was flagged.
     *
     * @var \NoResponse\Models\Shared\HighestBand|string|null $highestBand
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('highest_band')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\HighestBand|string|null')]
    public HighestBand|string|null $highestBand;

    /**
     * The latest reviewer decision, or null before any.
     *
     * @var \NoResponse\Models\Shared\AttendeeDecision|string|null $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttendeeDecision|string|null')]
    public AttendeeDecision|string|null $decision;

    /**
     *
     * @var ?string $decisionNote
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision_note')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $decisionNote = null;

    /**
     *
     * @var ?string $decidedBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decided_by')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $decidedBy = null;

    /**
     *
     * @var ?string $decidedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decided_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $decidedAt = null;

    /**
     *
     * @var ?string $lastScreeningId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('last_screening_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $lastScreeningId = null;

    /**
     *
     * @var ?string $screenedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('screened_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $screenedAt = null;

    /**
     * @param  string  $id
     * @param  string  $eventId
     * @param  string  $name
     * @param  \NoResponse\Models\Shared\MatchState|string  $matchState
     * @param  \NoResponse\Models\Shared\ScreeningCoverage  $coverage
     * @param  string  $createdAt
     * @param  string  $updatedAt
     * @param  \NoResponse\Models\Shared\ScreeningSpend  $spend
     * @param  ?string  $externalId
     * @param  ?string  $email
     * @param  ?string  $phone
     * @param  ?string  $company
     * @param  ?string  $city
     * @param  ?array<\NoResponse\Models\Shared\Handle>  $handles
     * @param  \NoResponse\Models\Shared\AttendeeRole|string|null  $role
     * @param  ?bool  $noProfileToCheck
     * @param  \NoResponse\Models\Shared\HighestBand|string|null  $highestBand
     * @param  \NoResponse\Models\Shared\AttendeeDecision|string|null  $decision
     * @param  ?string  $decisionNote
     * @param  ?string  $decidedBy
     * @param  ?string  $decidedAt
     * @param  ?string  $lastScreeningId
     * @param  ?string  $screenedAt
     * @phpstan-pure
     */
    public function __construct(string $id, string $eventId, string $name, MatchState|string $matchState, ScreeningCoverage $coverage, string $createdAt, string $updatedAt, ScreeningSpend $spend, ?string $externalId = null, ?string $email = null, ?string $phone = null, ?string $company = null, ?string $city = null, ?array $handles = null, AttendeeRole|string|null $role = null, ?bool $noProfileToCheck = null, HighestBand|string|null $highestBand = null, AttendeeDecision|string|null $decision = null, ?string $decisionNote = null, ?string $decidedBy = null, ?string $decidedAt = null, ?string $lastScreeningId = null, ?string $screenedAt = null)
    {
        $this->id = $id;
        $this->eventId = $eventId;
        $this->name = $name;
        $this->matchState = $matchState;
        $this->coverage = $coverage;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->spend = $spend;
        $this->externalId = $externalId;
        $this->email = $email;
        $this->phone = $phone;
        $this->company = $company;
        $this->city = $city;
        $this->handles = $handles;
        $this->role = $role;
        $this->noProfileToCheck = $noProfileToCheck;
        $this->highestBand = $highestBand;
        $this->decision = $decision;
        $this->decisionNote = $decisionNote;
        $this->decidedBy = $decidedBy;
        $this->decidedAt = $decidedAt;
        $this->lastScreeningId = $lastScreeningId;
        $this->screenedAt = $screenedAt;
    }
}