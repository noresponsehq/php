<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListMembersResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\MemberList $result
     */
    #[NoResponseMetadata('')]
    public Shared\MemberList $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\MemberList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\MemberList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}