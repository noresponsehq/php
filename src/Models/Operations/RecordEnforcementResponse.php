<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class RecordEnforcementResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Enforcement $result
     */
    #[NoResponseMetadata('')]
    public Shared\Enforcement $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Enforcement  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Enforcement $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}