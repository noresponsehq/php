<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ExportAccountResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountExport $result
     */
    #[NoResponseMetadata('')]
    public Shared\AccountExport $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AccountExport  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AccountExport $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}