<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class SearchAccountsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountDirectoryPage $result
     */
    #[NoResponseMetadata('')]
    public Shared\AccountDirectoryPage $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AccountDirectoryPage  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AccountDirectoryPage $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}