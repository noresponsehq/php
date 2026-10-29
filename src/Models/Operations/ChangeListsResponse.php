<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ChangeListsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\ListChange $result
     */
    #[NoResponseMetadata('')]
    public Shared\ListChange $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\ListChange  $result
     * @phpstan-pure
     */
    public function __construct(Shared\ListChange $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}