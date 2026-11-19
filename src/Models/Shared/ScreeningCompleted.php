<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningCompleted - A screening of a group finished. It counts only the people this screening set out to reach, not who they are: read the roster with GET /v1/workspaces/{workspace_id}/groups/{environment}/{group_id}/people to act on them. people_screened + partial_coverage = people_total, no_footprint counts screened people whose accounts were not found, and no_profile_to_check those the screening had nothing to look up for on any requested platform. A cancelled screening sends no event. */
class ScreeningCompleted
{
    /**
     * The screening that finished.
     *
     * @var string $screeningId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('screening_id')]
    public string $screeningId;

    /**
     * The group it screened.
     *
     * @var string $groupId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('group_id')]
    public string $groupId;

    /**
     * completed reached every person; partial left some not fully covered (partial_coverage); failed covered nobody.
     *
     * @var \NoResponse\Models\Shared\ScreeningCompletedStatus $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningCompletedStatus')]
    public ScreeningCompletedStatus $status;

    /**
     * Every person the screening set out to reach: those no screening had reached.
     *
     * @var int $peopleTotal
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('people_total')]
    public int $peopleTotal;

    /**
     * People the screening covered.
     *
     * @var int $peopleScreened
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('people_screened')]
    public int $peopleScreened;

    /**
     * Screened people whose accounts were not found (match_state none_found). A clean result for someone with no visible accounts is not the same as a clean result for someone whose accounts were read.
     *
     * @var int $noFootprint
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('no_footprint')]
    public int $noFootprint;

    /**
     * People the screening did not fully cover. Read each one's coverage on its person.
     *
     * @var int $partialCoverage
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('partial_coverage')]
    public int $partialCoverage;

    /**
     * When the screening finished; equal to the event's created_at.
     *
     * @var string $finishedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('finished_at')]
    public string $finishedAt;

    /**
     * Why a partial or failed screening stopped before reaching everyone, as the screening resource says: expired, worker_attempts_exhausted, attempts_exhausted or screening_unavailable.
     *
     * @var ?string $errorCode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('error_code')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $errorCode = null;

    /**
     * Screened people with no profile to check: the list gave nothing to look up on any requested platform, such as no handle, so nobody looked for a profile (no_profile_to_check on the person). Not in no_footprint, and not partial: nothing failed. Their lookups are on their reports.
     *
     * @var ?int $noProfileToCheck
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('no_profile_to_check')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $noProfileToCheck = null;

    /**
     * @param  string  $screeningId
     * @param  string  $groupId
     * @param  \NoResponse\Models\Shared\ScreeningCompletedStatus  $status
     * @param  int  $peopleTotal
     * @param  int  $peopleScreened
     * @param  int  $noFootprint
     * @param  int  $partialCoverage
     * @param  string  $finishedAt
     * @param  ?string  $errorCode
     * @param  ?int  $noProfileToCheck
     * @phpstan-pure
     */
    public function __construct(string $screeningId, string $groupId, ScreeningCompletedStatus $status, int $peopleTotal, int $peopleScreened, int $noFootprint, int $partialCoverage, string $finishedAt, ?string $errorCode = null, ?int $noProfileToCheck = null)
    {
        $this->screeningId = $screeningId;
        $this->groupId = $groupId;
        $this->status = $status;
        $this->peopleTotal = $peopleTotal;
        $this->peopleScreened = $peopleScreened;
        $this->noFootprint = $noFootprint;
        $this->partialCoverage = $partialCoverage;
        $this->finishedAt = $finishedAt;
        $this->errorCode = $errorCode;
        $this->noProfileToCheck = $noProfileToCheck;
    }
}