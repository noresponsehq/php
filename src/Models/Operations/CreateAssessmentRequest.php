<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CreateAssessmentRequest
{
    /**
     * Opaque client key, 16 to 128 characters of [A-Za-z0-9._:-] (a UUID or ULID fits). Scoped to the tenant principal and bound to the canonical body for 24 hours.
     *
     * @var string $idempotencyKey
     */
    #[NoResponseMetadata('header:style=simple,explode=false,name=Idempotency-Key')]
    public string $idempotencyKey;

    /**
     *
     * @var \NoResponse\Models\Shared\AssessmentRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\AssessmentRequest $body;

    /**
     * @param  string  $idempotencyKey
     * @param  \NoResponse\Models\Shared\AssessmentRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $idempotencyKey, Shared\AssessmentRequest $body)
    {
        $this->idempotencyKey = $idempotencyKey;
        $this->body = $body;
    }
}