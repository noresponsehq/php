<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CreateReviewViewResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\ReviewView $result
     */
    #[NoResponseMetadata('')]
    public Shared\ReviewView $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\ReviewView  $result
     * @phpstan-pure
     */
    public function __construct(Shared\ReviewView $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}