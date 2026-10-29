<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CancelCustomerExportRequest
{
    /**
     * Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.
     *
     * @var string $workspaceId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=workspace_id')]
    public string $workspaceId;

    /**
     *
     * @var string $exportId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=export_id')]
    public string $exportId;

    /**
     *
     * @var \NoResponse\Models\Shared\CustomerExportActionRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\CustomerExportActionRequest $body;

    /**
     * @param  string  $workspaceId
     * @param  string  $exportId
     * @param  \NoResponse\Models\Shared\CustomerExportActionRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, string $exportId, Shared\CustomerExportActionRequest $body)
    {
        $this->workspaceId = $workspaceId;
        $this->exportId = $exportId;
        $this->body = $body;
    }
}