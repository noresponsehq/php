<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class RotateIntegrationSecretResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Integration $result
     */
    #[NoResponseMetadata('')]
    public Shared\Integration $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Integration  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Integration $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}