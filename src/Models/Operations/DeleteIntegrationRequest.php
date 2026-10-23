<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class DeleteIntegrationRequest
{
    /**
     * Path segment, matched case-sensitively. A value that does not match the integration_id shape, or another workspace's id, answers 404.
     *
     * @var string $integrationId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=integration_id')]
    public string $integrationId;

    /**
     * @param  string  $integrationId
     * @phpstan-pure
     */
    public function __construct(string $integrationId)
    {
        $this->integrationId = $integrationId;
    }
}