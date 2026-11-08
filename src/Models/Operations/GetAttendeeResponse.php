<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class GetAttendeeResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AttendeeReport $result
     */
    #[NoResponseMetadata('')]
    public Shared\AttendeeReport $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AttendeeReport  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AttendeeReport $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}