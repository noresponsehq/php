<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class PreviewListResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\ListImpact $result
     */
    #[NoResponseMetadata('')]
    public Shared\ListImpact $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\ListImpact  $result
     * @phpstan-pure
     */
    public function __construct(Shared\ListImpact $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}