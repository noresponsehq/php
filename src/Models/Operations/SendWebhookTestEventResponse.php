<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class SendWebhookTestEventResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\WebhookTest $result
     */
    #[NoResponseMetadata('')]
    public Shared\WebhookTest $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\WebhookTest  $result
     * @phpstan-pure
     */
    public function __construct(Shared\WebhookTest $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}