<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class AggregateAssessmentsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AssessmentAggregate $result
     */
    #[NoResponseMetadata('')]
    public Shared\AssessmentAggregate $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AssessmentAggregate  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AssessmentAggregate $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}