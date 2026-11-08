<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ReviewAttendeeResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Attendee $result
     */
    #[NoResponseMetadata('')]
    public Shared\Attendee $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Attendee  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Attendee $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}