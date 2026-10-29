<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListReviewResolutionsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\ReviewResolutionList $result
     */
    #[NoResponseMetadata('')]
    public Shared\ReviewResolutionList $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\ReviewResolutionList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\ReviewResolutionList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}