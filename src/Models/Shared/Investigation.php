<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class Investigation
{
    /**
     * The denominator of a screening: accounts found, how many could be read, items read and the period they span, so a clean result is distinct from a person nobody could see.
     *
     * @var \NoResponse\Models\Shared\ScreeningCoverage $coverage
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('coverage')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningCoverage')]
    public ScreeningCoverage $coverage;

    /**
     * What screening cost, in US cents, in total and per implementation.
     *
     * @var \NoResponse\Models\Shared\ScreeningSpend $spend
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('spend')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningSpend')]
    public ScreeningSpend $spend;

    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var string $personId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('person_id')]
    public string $personId;

    /**
     *
     * @var \NoResponse\Models\Shared\InvestigationStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\InvestigationStatus|string')]
    public InvestigationStatus|string $status;

    /**
     *
     * @var \NoResponse\Models\Shared\ScreeningDepth|string $depth
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('depth')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningDepth|string')]
    public ScreeningDepth|string $depth;

    /**
     * $platforms
     *
     * @var array<string> $platforms
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('platforms')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>')]
    public array $platforms;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    public string $expiresAt;

    /**
     *
     * @var string $deadlineAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('deadline_at')]
    public string $deadlineAt;

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
     * @var \NoResponse\Models\Shared\PersonDecision|string|null $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PersonDecision|string|null')]
    public PersonDecision|string|null $decision;

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
     * @var ?string $groupId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('group_id')]
    public ?string $groupId;

    /**
     *
     * @var \NoResponse\Models\Shared\MatchState|string|null $matchState
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('match_state')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\MatchState|string|null')]
    public MatchState|string|null $matchState;

    /**
     *
     * @var ?string $errorCode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('error_code')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $errorCode = null;

    /**
     *
     * @var ?string $startedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('started_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $startedAt = null;

    /**
     *
     * @var ?string $finishedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('finished_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $finishedAt = null;

    /**
     * @param  \NoResponse\Models\Shared\ScreeningCoverage  $coverage
     * @param  \NoResponse\Models\Shared\ScreeningSpend  $spend
     * @param  string  $id
     * @param  string  $personId
     * @param  \NoResponse\Models\Shared\InvestigationStatus|string  $status
     * @param  \NoResponse\Models\Shared\ScreeningDepth|string  $depth
     * @param  array<string>  $platforms
     * @param  string  $createdAt
     * @param  string  $expiresAt
     * @param  string  $deadlineAt
     * @param  \NoResponse\Models\Shared\HighestBand|string|null  $highestBand
     * @param  \NoResponse\Models\Shared\PersonDecision|string|null  $decision
     * @param  ?string  $decisionNote
     * @param  ?string  $decidedBy
     * @param  ?string  $decidedAt
     * @param  ?string  $groupId
     * @param  \NoResponse\Models\Shared\MatchState|string|null  $matchState
     * @param  ?string  $errorCode
     * @param  ?string  $startedAt
     * @param  ?string  $finishedAt
     * @phpstan-pure
     */
    public function __construct(ScreeningCoverage $coverage, ScreeningSpend $spend, string $id, string $personId, InvestigationStatus|string $status, ScreeningDepth|string $depth, array $platforms, string $createdAt, string $expiresAt, string $deadlineAt, HighestBand|string|null $highestBand = null, PersonDecision|string|null $decision = null, ?string $decisionNote = null, ?string $decidedBy = null, ?string $decidedAt = null, ?string $groupId = null, MatchState|string|null $matchState = null, ?string $errorCode = null, ?string $startedAt = null, ?string $finishedAt = null)
    {
        $this->coverage = $coverage;
        $this->spend = $spend;
        $this->id = $id;
        $this->personId = $personId;
        $this->status = $status;
        $this->depth = $depth;
        $this->platforms = $platforms;
        $this->createdAt = $createdAt;
        $this->expiresAt = $expiresAt;
        $this->deadlineAt = $deadlineAt;
        $this->highestBand = $highestBand;
        $this->decision = $decision;
        $this->decisionNote = $decisionNote;
        $this->decidedBy = $decidedBy;
        $this->decidedAt = $decidedAt;
        $this->groupId = $groupId;
        $this->matchState = $matchState;
        $this->errorCode = $errorCode;
        $this->startedAt = $startedAt;
        $this->finishedAt = $finishedAt;
    }
}