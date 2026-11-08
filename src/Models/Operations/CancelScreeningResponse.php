<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CancelScreeningResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Screening $result
     */
    #[NoResponseMetadata('')]
    public Shared\Screening $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Screening  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Screening $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}