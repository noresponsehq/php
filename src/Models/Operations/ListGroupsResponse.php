<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListGroupsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\GroupList $result
     */
    #[NoResponseMetadata('')]
    public Shared\GroupList $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\GroupList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\GroupList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}