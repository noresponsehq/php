<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class GetAccountDecisionResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountDecisionSnapshot $result
     */
    #[NoResponseMetadata('')]
    public Shared\AccountDecisionSnapshot $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AccountDecisionSnapshot  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AccountDecisionSnapshot $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}