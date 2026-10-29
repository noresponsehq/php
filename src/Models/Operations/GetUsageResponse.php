<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class GetUsageResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Usage $result
     */
    #[NoResponseMetadata('')]
    public Shared\Usage $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Usage  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Usage $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}