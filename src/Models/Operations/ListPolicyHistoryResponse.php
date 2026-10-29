<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListPolicyHistoryResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\PolicyHistory $result
     */
    #[NoResponseMetadata('')]
    public Shared\PolicyHistory $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\PolicyHistory  $result
     * @phpstan-pure
     */
    public function __construct(Shared\PolicyHistory $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}