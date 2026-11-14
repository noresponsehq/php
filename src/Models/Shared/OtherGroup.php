<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** OtherGroup - A person of another group in the same environment who shares an email or phone with this one, as that group recorded them. */
class OtherGroup
{
    /**
     *
     * @var string $groupId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('group_id')]
    public string $groupId;

    /**
     *
     * @var string $groupName
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('group_name')]
    public string $groupName;

    /**
     *
     * @var string $groupStartsAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('group_starts_at')]
    public string $groupStartsAt;

    /**
     * The person on that group's list.
     *
     * @var string $personId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('person_id')]
    public string $personId;

    /**
     * Which identifiers match, in this order. external_id appears only beside email or phone: the same external id alone is not a match, since ticket numbers may be reused across groups.
     *
     * @var array<\NoResponse\Models\Shared\MatchedOn|string> $matchedOn
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('matched_on')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\MatchedOn|string>')]
    public array $matchedOn;

    /**
     * How sure the latest screening is that it found the person's accounts. unscreened until a screening reaches the person, and after one that had no profile to check (no_profile_to_check).
     *
     * @var \NoResponse\Models\Shared\MatchState|string $matchState
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('match_state')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\MatchState|string')]
    public MatchState|string $matchState;

    /**
     * true when that person's latest screening had no profile to check (see the person's no_profile_to_check). Left out otherwise.
     *
     * @var ?bool $noProfileToCheck
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('no_profile_to_check')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $noProfileToCheck = null;

    /**
     * That person's most severe band in that group, or null.
     *
     * @var \NoResponse\Models\Shared\HighestBand|string|null $highestBand
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('highest_band')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\HighestBand|string|null')]
    public HighestBand|string|null $highestBand;

    /**
     * The latest reviewer decision in that group, or null before any.
     *
     * @var \NoResponse\Models\Shared\PersonDecision|string|null $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PersonDecision|string|null')]
    public PersonDecision|string|null $decision;

    /**
     * Who made that decision.
     *
     * @var ?string $decidedBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decided_by')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $decidedBy = null;

    /**
     * When that decision was made.
     *
     * @var ?string $decidedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decided_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $decidedAt = null;

    /**
     * @param  string  $groupId
     * @param  string  $groupName
     * @param  string  $groupStartsAt
     * @param  string  $personId
     * @param  array<\NoResponse\Models\Shared\MatchedOn|string>  $matchedOn
     * @param  \NoResponse\Models\Shared\MatchState|string  $matchState
     * @param  ?bool  $noProfileToCheck
     * @param  \NoResponse\Models\Shared\HighestBand|string|null  $highestBand
     * @param  \NoResponse\Models\Shared\PersonDecision|string|null  $decision
     * @param  ?string  $decidedBy
     * @param  ?string  $decidedAt
     * @phpstan-pure
     */
    public function __construct(string $groupId, string $groupName, string $groupStartsAt, string $personId, array $matchedOn, MatchState|string $matchState, ?bool $noProfileToCheck = null, HighestBand|string|null $highestBand = null, PersonDecision|string|null $decision = null, ?string $decidedBy = null, ?string $decidedAt = null)
    {
        $this->groupId = $groupId;
        $this->groupName = $groupName;
        $this->groupStartsAt = $groupStartsAt;
        $this->personId = $personId;
        $this->matchedOn = $matchedOn;
        $this->matchState = $matchState;
        $this->noProfileToCheck = $noProfileToCheck;
        $this->highestBand = $highestBand;
        $this->decision = $decision;
        $this->decidedBy = $decidedBy;
        $this->decidedAt = $decidedAt;
    }
}