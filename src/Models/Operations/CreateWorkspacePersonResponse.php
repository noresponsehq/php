<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CreateWorkspacePersonResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\WorkspacePersonResult $result
     */
    #[NoResponseMetadata('')]
    public Shared\WorkspacePersonResult $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\WorkspacePersonResult  $result
     * @phpstan-pure
     */
    public function __construct(Shared\WorkspacePersonResult $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}