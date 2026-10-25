<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class GetAssessmentRequest
{
    /**
     * Path segment, matched case-sensitively. A value that does not match the assessment_id shape answers 404, not 400.
     *
     * @var string $assessmentId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=assessment_id')]
    public string $assessmentId;

    /**
     * Optional standard or separately authorised detailed customer view; raw is rejected.
     *
     * @var \NoResponse\Models\Shared\ResponseMode|string|null $responseMode
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=response_mode')]
    public Shared\ResponseMode|string|null $responseMode = null;

    /**
     * @param  string  $assessmentId
     * @param  \NoResponse\Models\Shared\ResponseMode|string|null  $responseMode
     * @phpstan-pure
     */
    public function __construct(string $assessmentId, Shared\ResponseMode|string|null $responseMode = null)
    {
        $this->assessmentId = $assessmentId;
        $this->responseMode = $responseMode;
    }
}