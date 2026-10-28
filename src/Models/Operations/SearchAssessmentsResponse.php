<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class SearchAssessmentsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AssessmentSearchPage $result
     */
    #[NoResponseMetadata('')]
    public Shared\AssessmentSearchPage $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AssessmentSearchPage  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AssessmentSearchPage $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}