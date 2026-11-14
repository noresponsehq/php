<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class GetGroupResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Group $result
     */
    #[NoResponseMetadata('')]
    public Shared\Group $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Group  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Group $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}