<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class RecordAssessmentOutcomeRequest
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
     * @var \NoResponse\Models\Shared\AssessmentOutcomeRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\AssessmentOutcomeRequest $body;

    /**
     * Opaque client key, 16 to 128 characters of [A-Za-z0-9._:-] (a UUID or ULID fits). Scoped to the tenant principal and bound to the canonical body for 24 hours. Optional: the SDK generates a UUID when you omit it and sends the same key on every retry of the call.
     *
     * @var ?string $idempotencyKey
     */
    #[NoResponseMetadata('header:style=simple,explode=false,name=Idempotency-Key')]
    public ?string $idempotencyKey = null;

    /**
     * @param  string  $assessmentId
     * @param  \NoResponse\Models\Shared\AssessmentOutcomeRequest  $body
     * @param  ?string  $idempotencyKey
     * @phpstan-pure
     */
    public function __construct(string $assessmentId, Shared\AssessmentOutcomeRequest $body, ?string $idempotencyKey = null)
    {
        $this->assessmentId = $assessmentId;
        $this->body = $body;
        $this->idempotencyKey = $idempotencyKey;
    }
}