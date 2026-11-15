<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CreateInvestigationResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Investigation $result
     */
    #[NoResponseMetadata('')]
    public Shared\Investigation $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Investigation  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Investigation $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}