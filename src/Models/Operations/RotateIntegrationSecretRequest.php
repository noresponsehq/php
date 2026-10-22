<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class RotateIntegrationSecretRequest
{
    /**
     * Path segment, matched case-sensitively. A value that does not match the integration_id shape, or another tenant's id, answers 404.
     *
     * @var string $integrationId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=integration_id')]
    public string $integrationId;

    /**
     *
     * @var \NoResponse\Models\Shared\IntegrationRotationRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\IntegrationRotationRequest $body;

    /**
     * @param  string  $integrationId
     * @param  \NoResponse\Models\Shared\IntegrationRotationRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $integrationId, Shared\IntegrationRotationRequest $body)
    {
        $this->integrationId = $integrationId;
        $this->body = $body;
    }
}