<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CreateInviteResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Invite $result
     */
    #[NoResponseMetadata('')]
    public Shared\Invite $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Invite  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Invite $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}