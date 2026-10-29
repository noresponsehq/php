<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListReviewSubjectsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\ReviewSubjectList $result
     */
    #[NoResponseMetadata('')]
    public Shared\ReviewSubjectList $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\ReviewSubjectList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\ReviewSubjectList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}