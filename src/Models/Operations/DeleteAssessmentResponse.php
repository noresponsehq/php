<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class DeleteAssessmentResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AssessmentDeletion $result
     */
    #[NoResponseMetadata('')]
    public Shared\AssessmentDeletion $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AssessmentDeletion  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AssessmentDeletion $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}