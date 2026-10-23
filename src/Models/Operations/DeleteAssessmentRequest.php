<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class DeleteAssessmentRequest
{
    /**
     * Path segment, matched case-sensitively. A value that does not match the assessment_id shape answers 404, not 400.
     *
     * @var string $assessmentId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=assessment_id')]
    public string $assessmentId;

    /**
     * @param  string  $assessmentId
     * @phpstan-pure
     */
    public function __construct(string $assessmentId)
    {
        $this->assessmentId = $assessmentId;
    }
}