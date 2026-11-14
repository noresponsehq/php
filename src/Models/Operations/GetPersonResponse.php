<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class GetPersonResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\PersonReport $result
     */
    #[NoResponseMetadata('')]
    public Shared\PersonReport $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\PersonReport  $result
     * @phpstan-pure
     */
    public function __construct(Shared\PersonReport $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}