<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListReviewViewsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\ReviewViewList $result
     */
    #[NoResponseMetadata('')]
    public Shared\ReviewViewList $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\ReviewViewList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\ReviewViewList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}