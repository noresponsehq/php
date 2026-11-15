<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class GetInvestigationResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\InvestigationReport $result
     */
    #[NoResponseMetadata('')]
    public Shared\InvestigationReport $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\InvestigationReport  $result
     * @phpstan-pure
     */
    public function __construct(Shared\InvestigationReport $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}