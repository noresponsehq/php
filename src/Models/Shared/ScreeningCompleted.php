<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningCompleted - A screening of an event finished. It counts only the attendees this screening set out to reach, not who they are: read the roster with GET /v1/workspaces/{workspace_id}/events/{environment}/{event_id}/attendees, filtered by band, to act on them. attendees_screened + partial_coverage = attendees_total, attendees_flagged is the sum of by_band, and no_footprint counts screened attendees with no flag whose accounts were not found. A cancelled screening sends no event. */
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
     * The event it screened.
     *
     * @var string $eventId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('event_id')]
    public string $eventId;

    /**
     * completed reached every attendee; partial left some not fully covered (partial_coverage); failed covered nobody.
     *
     * @var \NoResponse\Models\Shared\ScreeningCompletedStatus $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningCompletedStatus')]
    public ScreeningCompletedStatus $status;

    /**
     * Every attendee the screening set out to reach: those no screening had reached and those on watch or escalated.
     *
     * @var int $attendeesTotal
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attendees_total')]
    public int $attendeesTotal;

    /**
     * Attendees the screening covered, flagged or not.
     *
     * @var int $attendeesScreened
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attendees_screened')]
    public int $attendeesScreened;

    /**
     * Screened attendees with a finding: the sum of by_band.
     *
     * @var int $attendeesFlagged
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attendees_flagged')]
    public int $attendeesFlagged;

    /**
     * Screened attendees by the band of their most severe finding.
     *
     * @var \NoResponse\Models\Shared\ScreeningCompletedByBand $byBand
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('by_band')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningCompletedByBand')]
    public ScreeningCompletedByBand $byBand;

    /**
     * Screened attendees with no finding whose accounts were not found (match_state none_found). A clean result for someone with no visible accounts is not the same as a clean result for someone whose accounts were read.
     *
     * @var int $noFootprint
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('no_footprint')]
    public int $noFootprint;

    /**
     * Attendees the screening did not fully cover. Read each one's coverage on its attendee.
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
     * @param  string  $screeningId
     * @param  string  $eventId
     * @param  \NoResponse\Models\Shared\ScreeningCompletedStatus  $status
     * @param  int  $attendeesTotal
     * @param  int  $attendeesScreened
     * @param  int  $attendeesFlagged
     * @param  \NoResponse\Models\Shared\ScreeningCompletedByBand  $byBand
     * @param  int  $noFootprint
     * @param  int  $partialCoverage
     * @param  string  $finishedAt
     * @param  ?string  $errorCode
     * @phpstan-pure
     */
    public function __construct(string $screeningId, string $eventId, ScreeningCompletedStatus $status, int $attendeesTotal, int $attendeesScreened, int $attendeesFlagged, ScreeningCompletedByBand $byBand, int $noFootprint, int $partialCoverage, string $finishedAt, ?string $errorCode = null)
    {
        $this->screeningId = $screeningId;
        $this->eventId = $eventId;
        $this->status = $status;
        $this->attendeesTotal = $attendeesTotal;
        $this->attendeesScreened = $attendeesScreened;
        $this->attendeesFlagged = $attendeesFlagged;
        $this->byBand = $byBand;
        $this->noFootprint = $noFootprint;
        $this->partialCoverage = $partialCoverage;
        $this->finishedAt = $finishedAt;
        $this->errorCode = $errorCode;
    }
}