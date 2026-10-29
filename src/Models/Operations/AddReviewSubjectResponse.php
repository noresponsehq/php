<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class AddReviewSubjectResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\ReviewSubjectChange $result
     */
    #[NoResponseMetadata('')]
    public Shared\ReviewSubjectChange $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\ReviewSubjectChange  $result
     * @phpstan-pure
     */
    public function __construct(Shared\ReviewSubjectChange $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}