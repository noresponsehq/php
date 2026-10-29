<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class SummarizeWorkspaceOperationsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\WorkspaceOperationsSummary $result
     */
    #[NoResponseMetadata('')]
    public Shared\WorkspaceOperationsSummary $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\WorkspaceOperationsSummary  $result
     * @phpstan-pure
     */
    public function __construct(Shared\WorkspaceOperationsSummary $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}