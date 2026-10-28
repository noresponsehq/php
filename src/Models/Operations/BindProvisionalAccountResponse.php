<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class BindProvisionalAccountResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountBinding $result
     */
    #[NoResponseMetadata('')]
    public Shared\AccountBinding $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AccountBinding  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AccountBinding $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}