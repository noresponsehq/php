<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class GetErasureReceiptResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\ErasureReceipt $result
     */
    #[NoResponseMetadata('')]
    public Shared\ErasureReceipt $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\ErasureReceipt  $result
     * @phpstan-pure
     */
    public function __construct(Shared\ErasureReceipt $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}