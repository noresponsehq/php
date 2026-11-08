<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListEventsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\EventList $result
     */
    #[NoResponseMetadata('')]
    public Shared\EventList $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\EventList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\EventList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}