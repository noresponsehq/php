<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class RevokeKeyResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Key $result
     */
    #[NoResponseMetadata('')]
    public Shared\Key $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Key  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Key $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}