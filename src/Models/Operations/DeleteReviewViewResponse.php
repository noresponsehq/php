<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;


class DeleteReviewViewResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     * @param  array<string, array<string>>  $headers
     * @phpstan-pure
     */
    public function __construct(?array $headers = [])
    {
        $this->headers = $headers;
    }
}