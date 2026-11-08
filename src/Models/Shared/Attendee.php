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
     * How sure the latest screening is that it found the attendee's accounts. unscreened until a screening reaches the attendee.
     *
     * @var \NoResponse\Models\Shared\MatchState|string $matchState
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('match_state')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\MatchState|string')]
    public MatchState|string $matchState;

    /**
     * What the latest screening read, per platform.
     *
     * @var \NoResponse\Models\Shared\AttendeeCoverage $coverage
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('coverage')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttendeeCoverage')]
    public AttendeeCoverage $coverage;

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
     * @param  \NoResponse\Models\Shared\AttendeeCoverage  $coverage
     * @param  string  $createdAt
     * @param  string  $updatedAt
     * @param  ?string  $externalId
     * @param  ?string  $email
     * @param  ?string  $phone
     * @param  ?string  $company
     * @param  ?string  $city
     * @param  ?array<\NoResponse\Models\Shared\Handle>  $handles
     * @param  \NoResponse\Models\Shared\HighestBand|string|null  $highestBand
     * @param  \NoResponse\Models\Shared\AttendeeDecision|string|null  $decision
     * @param  ?string  $decisionNote
     * @param  ?string  $decidedBy
     * @param  ?string  $decidedAt
     * @param  ?string  $lastScreeningId
     * @param  ?string  $screenedAt
     * @phpstan-pure
     */
    public function __construct(string $id, string $eventId, string $name, MatchState|string $matchState, AttendeeCoverage $coverage, string $createdAt, string $updatedAt, ?string $externalId = null, ?string $email = null, ?string $phone = null, ?string $company = null, ?string $city = null, ?array $handles = null, HighestBand|string|null $highestBand = null, AttendeeDecision|string|null $decision = null, ?string $decisionNote = null, ?string $decidedBy = null, ?string $decidedAt = null, ?string $lastScreeningId = null, ?string $screenedAt = null)
    {
        $this->id = $id;
        $this->eventId = $eventId;
        $this->name = $name;
        $this->matchState = $matchState;
        $this->coverage = $coverage;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->externalId = $externalId;
        $this->email = $email;
        $this->phone = $phone;
        $this->company = $company;
        $this->city = $city;
        $this->handles = $handles;
        $this->highestBand = $highestBand;
        $this->decision = $decision;
        $this->decisionNote = $decisionNote;
        $this->decidedBy = $decidedBy;
        $this->decidedAt = $decidedAt;
        $this->lastScreeningId = $lastScreeningId;
        $this->screenedAt = $screenedAt;
    }
}