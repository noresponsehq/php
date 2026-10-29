<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class DownloadCustomerExportChunkRequest
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
     * @var int $chunkIndex
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=chunk_index')]
    public int $chunkIndex;

    /**
     * @param  string  $workspaceId
     * @param  string  $exportId
     * @param  int  $chunkIndex
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, string $exportId, int $chunkIndex)
    {
        $this->workspaceId = $workspaceId;
        $this->exportId = $exportId;
        $this->chunkIndex = $chunkIndex;
    }
}