<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ResolveReviewResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Review $result
     */
    #[NoResponseMetadata('')]
    public Shared\Review $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Review  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Review $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}