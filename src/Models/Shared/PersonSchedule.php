<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PersonSchedule - The person's rerun schedule. Each due run starts a full investigation of the person, as POST /v1/investigations with no platforms does, and its changes are stored as changes. The schedule lives in the database and the worker runs it, so it survives restarts and releases; each due run starts exactly one investigation. */
class PersonSchedule
{
    /**
     * How often the person is investigated again: daily, weekly or monthly, counted from when the schedule was set; off runs no scheduled investigation.
     *
     * @var \NoResponse\Models\Shared\SchedulePeriod|string $period
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('period')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\SchedulePeriod|string')]
    public SchedulePeriod|string $period;

    /**
     * When the next scheduled investigation starts, within a minute. null when the schedule is off.
     *
     * @var ?string $nextRunAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_run_at')]
    public ?string $nextRunAt;

    /**
     * The investigation the schedule last started. null before its first run.
     *
     * @var ?string $lastInvestigationId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('last_investigation_id')]
    public ?string $lastInvestigationId;

    /**
     * Why the last due run started no investigation, as the problem code its start would have answered. null when the last due run started one, or none has come due. A run that started none is not retried: the schedule moves to its next period.
     *
     * @var \NoResponse\Models\Shared\LastError|string|null $lastError
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('last_error')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\LastError|string|null')]
    public LastError|string|null $lastError;

    /**
     *
     * @var ?string $updatedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('updated_at')]
    public ?string $updatedAt;

    /**
     * Who last set the schedule.
     *
     * @var ?string $updatedBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('updated_by')]
    public ?string $updatedBy;

    /**
     * @param  \NoResponse\Models\Shared\SchedulePeriod|string  $period
     * @param  ?string  $nextRunAt
     * @param  ?string  $lastInvestigationId
     * @param  \NoResponse\Models\Shared\LastError|string|null  $lastError
     * @param  ?string  $updatedAt
     * @param  ?string  $updatedBy
     * @phpstan-pure
     */
    public function __construct(SchedulePeriod|string $period, ?string $nextRunAt = null, ?string $lastInvestigationId = null, LastError|string|null $lastError = null, ?string $updatedAt = null, ?string $updatedBy = null)
    {
        $this->period = $period;
        $this->nextRunAt = $nextRunAt;
        $this->lastInvestigationId = $lastInvestigationId;
        $this->lastError = $lastError;
        $this->updatedAt = $updatedAt;
        $this->updatedBy = $updatedBy;
    }
}