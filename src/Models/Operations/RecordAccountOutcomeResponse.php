<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class RecordAccountOutcomeResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountOutcome $result
     */
    #[NoResponseMetadata('')]
    public Shared\AccountOutcome $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AccountOutcome  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AccountOutcome $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}