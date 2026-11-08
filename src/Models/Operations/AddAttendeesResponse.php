<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class AddAttendeesResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AttendeeBatch $result
     */
    #[NoResponseMetadata('')]
    public Shared\AttendeeBatch $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AttendeeBatch  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AttendeeBatch $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}