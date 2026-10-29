<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ExportReviewResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Export $result
     */
    #[NoResponseMetadata('')]
    public Shared\Export $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Export  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Export $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}