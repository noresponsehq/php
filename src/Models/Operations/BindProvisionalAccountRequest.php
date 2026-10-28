<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class BindProvisionalAccountRequest
{
    /**
     * Path segment, matched case-sensitively. A value that does not match the assessment_id shape answers 404, not 400.
     *
     * @var string $assessmentId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=assessment_id')]
    public string $assessmentId;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountBindingRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\AccountBindingRequest $body;

    /**
     * @param  string  $assessmentId
     * @param  \NoResponse\Models\Shared\AccountBindingRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $assessmentId, Shared\AccountBindingRequest $body)
    {
        $this->assessmentId = $assessmentId;
        $this->body = $body;
    }
}