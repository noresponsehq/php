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
     * The person on that group's list.
     *
     * @var string $personId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('person_id')]
    public string $personId;

    /**
     * The same workspace person explicitly belongs to this group. Membership requires an explicit person or customer reference.
     *
     * @var array<\NoResponse\Models\Shared\OtherGroupMatchedOn|string> $matchedOn
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('matched_on')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\OtherGroupMatchedOn|string>')]
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
     * The other group's optional event start; null for an ongoing group.
     *
     * @var ?string $groupStartsAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('group_starts_at')]
    public ?string $groupStartsAt;

    /**
     * true when that person's latest screening had no profile to check (see the person's no_profile_to_check). Left out otherwise.
     *
     * @var ?bool $noProfileToCheck
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('no_profile_to_check')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $noProfileToCheck = null;

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
     * @param  string  $personId
     * @param  array<\NoResponse\Models\Shared\OtherGroupMatchedOn|string>  $matchedOn
     * @param  \NoResponse\Models\Shared\MatchState|string  $matchState
     * @param  ?string  $groupStartsAt
     * @param  ?bool  $noProfileToCheck
     * @param  \NoResponse\Models\Shared\PersonDecision|string|null  $decision
     * @param  ?string  $decidedBy
     * @param  ?string  $decidedAt
     * @phpstan-pure
     */
    public function __construct(string $groupId, string $groupName, string $personId, array $matchedOn, MatchState|string $matchState, ?string $groupStartsAt = null, ?bool $noProfileToCheck = null, PersonDecision|string|null $decision = null, ?string $decidedBy = null, ?string $decidedAt = null)
    {
        $this->groupId = $groupId;
        $this->groupName = $groupName;
        $this->personId = $personId;
        $this->matchedOn = $matchedOn;
        $this->matchState = $matchState;
        $this->groupStartsAt = $groupStartsAt;
        $this->noProfileToCheck = $noProfileToCheck;
        $this->decision = $decision;
        $this->decidedBy = $decidedBy;
        $this->decidedAt = $decidedAt;
    }
}