<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListInvitesResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\InviteList $result
     */
    #[NoResponseMetadata('')]
    public Shared\InviteList $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\InviteList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\InviteList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}