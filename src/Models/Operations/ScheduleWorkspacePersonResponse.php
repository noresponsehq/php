<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ScheduleWorkspacePersonResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\PersonSchedule $result
     */
    #[NoResponseMetadata('')]
    public Shared\PersonSchedule $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\PersonSchedule  $result
     * @phpstan-pure
     */
    public function __construct(Shared\PersonSchedule $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}