<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class RotateWebhookSigningKeyRequest
{
    /**
     * The endpoint's whe_ id. An id that is unknown, malformed or another workspace's answers 404.
     *
     * @var string $endpointId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=endpoint_id')]
    public string $endpointId;

    /**
     *
     * @var \NoResponse\Models\Shared\WebhookKeyRotationRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\WebhookKeyRotationRequest $body;

    /**
     * @param  string  $endpointId
     * @param  \NoResponse\Models\Shared\WebhookKeyRotationRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $endpointId, Shared\WebhookKeyRotationRequest $body)
    {
        $this->endpointId = $endpointId;
        $this->body = $body;
    }
}