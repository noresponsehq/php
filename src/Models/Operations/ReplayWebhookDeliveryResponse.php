<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ReplayWebhookDeliveryResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\WebhookReplay $result
     */
    #[NoResponseMetadata('')]
    public Shared\WebhookReplay $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\WebhookReplay  $result
     * @phpstan-pure
     */
    public function __construct(Shared\WebhookReplay $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}