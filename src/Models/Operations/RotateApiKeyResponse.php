<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class RotateApiKeyResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\KeyRotation $result
     */
    #[NoResponseMetadata('')]
    public Shared\KeyRotation $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\KeyRotation  $result
     * @phpstan-pure
     */
    public function __construct(Shared\KeyRotation $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}