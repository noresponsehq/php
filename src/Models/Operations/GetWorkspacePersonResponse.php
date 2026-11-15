<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class GetWorkspacePersonResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\WorkspacePersonReport $result
     */
    #[NoResponseMetadata('')]
    public Shared\WorkspacePersonReport $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\WorkspacePersonReport  $result
     * @phpstan-pure
     */
    public function __construct(Shared\WorkspacePersonReport $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}