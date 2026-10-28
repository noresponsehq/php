<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListAccountOutcomesResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountOutcomePage $result
     */
    #[NoResponseMetadata('')]
    public Shared\AccountOutcomePage $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AccountOutcomePage  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AccountOutcomePage $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}