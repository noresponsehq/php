<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListCustomerExportsRequest
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
     * @var \NoResponse\Models\Shared\CustomerExportRequestKind|string $kind
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=kind')]
    public Shared\CustomerExportRequestKind|string $kind;

    /**
     *
     * @var \NoResponse\Models\Shared\Environment|string $environment
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=environment')]
    public Shared\Environment|string $environment;

    /**
     *
     * @var ?string $cursor
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=cursor')]
    public ?string $cursor = null;

    /**
     *
     * @var ?int $limit
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=limit')]
    public ?int $limit = null;

    /**
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\CustomerExportRequestKind|string  $kind
     * @param  \NoResponse\Models\Shared\Environment|string  $environment
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, Shared\CustomerExportRequestKind|string $kind, Shared\Environment|string $environment, ?string $cursor = null, ?int $limit = 25)
    {
        $this->workspaceId = $workspaceId;
        $this->kind = $kind;
        $this->environment = $environment;
        $this->cursor = $cursor;
        $this->limit = $limit;
    }
}