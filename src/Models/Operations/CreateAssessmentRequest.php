<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CreateAssessmentRequest
{
    /**
     *
     * @var \NoResponse\Models\Shared\AssessmentRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\AssessmentRequest $body;

    /**
     * Opaque client key, 16 to 128 characters of [A-Za-z0-9._:-] (a UUID or ULID fits). Scoped to the workspace principal and bound to the canonical body for 24 hours. Optional: the SDK generates a UUID when you omit it and sends the same key on every retry of the call.
     *
     * @var ?string $idempotencyKey
     */
    #[NoResponseMetadata('header:style=simple,explode=false,name=Idempotency-Key')]
    public ?string $idempotencyKey = null;

    /**
     * @param  \NoResponse\Models\Shared\AssessmentRequest  $body
     * @param  ?string  $idempotencyKey
     * @phpstan-pure
     */
    public function __construct(Shared\AssessmentRequest $body, ?string $idempotencyKey = null)
    {
        $this->body = $body;
        $this->idempotencyKey = $idempotencyKey;
    }
}