<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListWebhookEndpointsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\WebhookEndpointList $result
     */
    #[NoResponseMetadata('')]
    public Shared\WebhookEndpointList $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\WebhookEndpointList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\WebhookEndpointList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}