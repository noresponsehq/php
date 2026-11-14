<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Screening - A screening and its progress. */
class Screening
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var string $groupId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('group_id')]
    public string $groupId;

    /**
     *
     * @var \NoResponse\Models\Shared\AuditSettingsEnvironment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AuditSettingsEnvironment|string')]
    public AuditSettingsEnvironment|string $environment;

    /**
     * partial finished with some people or platforms not covered; people_failed and people_partial count them.
     *
     * @var \NoResponse\Models\Shared\ScreeningStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningStatus|string')]
    public ScreeningStatus|string $status;

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
     * @var array<\NoResponse\Models\Shared\HandlePlatform|string> $platforms
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('platforms')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\HandlePlatform|string>')]
    public array $platforms;

    /**
     *
     * @var string $requestedBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('requested_by')]
    public string $requestedBy;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * A screening still running then fails with error_code expired.
     *
     * @var string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    public string $expiresAt;

    /**
     * People selected when the screening started.
     *
     * @var int $peopleTotal
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('people_total')]
    public int $peopleTotal;

    /**
     * People screened so far, failed ones included.
     *
     * @var int $peopleDone
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('people_done')]
    public int $peopleDone;

    /**
     *
     * @var int $peopleFlagged
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('people_flagged')]
    public int $peopleFlagged;

    /**
     *
     * @var int $peopleFailed
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('people_failed')]
    public int $peopleFailed;

    /**
     * People screened with some requested platform not covered; their coverage names which.
     *
     * @var int $peoplePartial
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('people_partial')]
    public int $peoplePartial;

    /**
     * What the screening was estimated to cost when it started, in minor units of USD (cents): its people at its depth and platforms. Until the screening finishes, what it has not yet spent counts against the environment's screening_daily_cap.
     *
     * @var int $estimatedSpend
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('estimated_spend')]
    public int $estimatedSpend;

    /**
     * What the people it has screened recorded, in minor units of USD. Each counts toward the UTC day it was recorded on; a failed person records nothing.
     *
     * @var int $spent
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('spent')]
    public int $spent;

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
     * Why a failed or cancelled screening stopped.
     *
     * @var ?string $errorCode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('error_code')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $errorCode = null;

    /**
     * @param  string  $id
     * @param  string  $groupId
     * @param  \NoResponse\Models\Shared\AuditSettingsEnvironment|string  $environment
     * @param  \NoResponse\Models\Shared\ScreeningStatus|string  $status
     * @param  \NoResponse\Models\Shared\ScreeningDepth|string  $depth
     * @param  array<\NoResponse\Models\Shared\HandlePlatform|string>  $platforms
     * @param  string  $requestedBy
     * @param  string  $createdAt
     * @param  string  $expiresAt
     * @param  int  $peopleTotal
     * @param  int  $peopleDone
     * @param  int  $peopleFlagged
     * @param  int  $peopleFailed
     * @param  int  $peoplePartial
     * @param  int  $estimatedSpend
     * @param  int  $spent
     * @param  \NoResponse\Models\Shared\ScreeningSpend  $spend
     * @param  ?string  $startedAt
     * @param  ?string  $finishedAt
     * @param  ?string  $errorCode
     * @phpstan-pure
     */
    public function __construct(string $id, string $groupId, AuditSettingsEnvironment|string $environment, ScreeningStatus|string $status, ScreeningDepth|string $depth, array $platforms, string $requestedBy, string $createdAt, string $expiresAt, int $peopleTotal, int $peopleDone, int $peopleFlagged, int $peopleFailed, int $peoplePartial, int $estimatedSpend, int $spent, ScreeningSpend $spend, ?string $startedAt = null, ?string $finishedAt = null, ?string $errorCode = null)
    {
        $this->id = $id;
        $this->groupId = $groupId;
        $this->environment = $environment;
        $this->status = $status;
        $this->depth = $depth;
        $this->platforms = $platforms;
        $this->requestedBy = $requestedBy;
        $this->createdAt = $createdAt;
        $this->expiresAt = $expiresAt;
        $this->peopleTotal = $peopleTotal;
        $this->peopleDone = $peopleDone;
        $this->peopleFlagged = $peopleFlagged;
        $this->peopleFailed = $peopleFailed;
        $this->peoplePartial = $peoplePartial;
        $this->estimatedSpend = $estimatedSpend;
        $this->spent = $spent;
        $this->spend = $spend;
        $this->startedAt = $startedAt;
        $this->finishedAt = $finishedAt;
        $this->errorCode = $errorCode;
    }
}