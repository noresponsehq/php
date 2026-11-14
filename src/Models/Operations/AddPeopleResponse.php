<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class AddPeopleResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\PersonBatch $result
     */
    #[NoResponseMetadata('')]
    public Shared\PersonBatch $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\PersonBatch  $result
     * @phpstan-pure
     */
    public function __construct(Shared\PersonBatch $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}