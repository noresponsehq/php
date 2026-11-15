<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListInvestigationsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\InvestigationsList $result
     */
    #[NoResponseMetadata('')]
    public Shared\InvestigationsList $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\InvestigationsList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\InvestigationsList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}