<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListAccountsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountList $result
     */
    #[NoResponseMetadata('')]
    public Shared\AccountList $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AccountList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AccountList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}