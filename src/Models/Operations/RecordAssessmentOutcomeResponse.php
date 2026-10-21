<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class RecordAssessmentOutcomeResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AssessmentOutcome $result
     */
    #[NoResponseMetadata('')]
    public Shared\AssessmentOutcome $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AssessmentOutcome  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AssessmentOutcome $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}