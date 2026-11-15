<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListWorkspacePeopleResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\WorkspacePeopleList $result
     */
    #[NoResponseMetadata('')]
    public Shared\WorkspacePeopleList $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\WorkspacePeopleList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\WorkspacePeopleList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}