<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PersonScheduleRequest - The schedule to set. */
class PersonScheduleRequest
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
     * @param  \NoResponse\Models\Shared\SchedulePeriod|string  $period
     * @phpstan-pure
     */
    public function __construct(SchedulePeriod|string $period)
    {
        $this->period = $period;
    }
}