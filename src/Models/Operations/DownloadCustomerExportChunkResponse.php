<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class DownloadCustomerExportChunkResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\CustomerExportChunk $result
     */
    #[NoResponseMetadata('')]
    public Shared\CustomerExportChunk $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\CustomerExportChunk  $result
     * @phpstan-pure
     */
    public function __construct(Shared\CustomerExportChunk $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}