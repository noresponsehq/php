<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class RotateWebhookSigningKeyResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\WebhookKeyRotation $result
     */
    #[NoResponseMetadata('')]
    public Shared\WebhookKeyRotation $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\WebhookKeyRotation  $result
     * @phpstan-pure
     */
    public function __construct(Shared\WebhookKeyRotation $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}