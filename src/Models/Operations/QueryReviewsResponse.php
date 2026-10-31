<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class QueryReviewsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\ReviewList $result
     */
    #[NoResponseMetadata('')]
    public Shared\ReviewList $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\ReviewList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\ReviewList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}