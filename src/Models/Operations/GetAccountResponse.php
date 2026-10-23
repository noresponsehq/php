<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class GetAccountResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Account $result
     */
    #[NoResponseMetadata('')]
    public Shared\Account $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Account  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Account $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}