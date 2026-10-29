<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CreateCustomerExportRequest
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
     * @var \NoResponse\Models\Shared\CustomerExportRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\CustomerExportRequest $body;

    /**
     *
     * @var ?string $idempotencyKey
     */
    #[NoResponseMetadata('header:style=simple,explode=false,name=Idempotency-Key')]
    public ?string $idempotencyKey = null;

    /**
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\CustomerExportRequest  $body
     * @param  ?string  $idempotencyKey
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, Shared\CustomerExportRequest $body, ?string $idempotencyKey = null)
    {
        $this->workspaceId = $workspaceId;
        $this->body = $body;
        $this->idempotencyKey = $idempotencyKey;
    }
}