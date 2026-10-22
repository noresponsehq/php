<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class DeleteWebhookEndpointRequest
{
    /**
     * The endpoint's whe_ id. An id that is unknown, malformed or another tenant's answers 404.
     *
     * @var string $endpointId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=endpoint_id')]
    public string $endpointId;

    /**
     * @param  string  $endpointId
     * @phpstan-pure
     */
    public function __construct(string $endpointId)
    {
        $this->endpointId = $endpointId;
    }
}