<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CreateWebhookEndpointResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\WebhookEndpointCreated $result
     */
    #[NoResponseMetadata('')]
    public Shared\WebhookEndpointCreated $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\WebhookEndpointCreated  $result
     * @phpstan-pure
     */
    public function __construct(Shared\WebhookEndpointCreated $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}