<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class RecordAccountOutcomeRequest
{
    /**
     * The account_id the workspace sends with its assessments, as one path segment (percent-encode '|' and ':' if the client requires it). A value that does not match the account_id shape answers 400 invalid_request.
     *
     * @var string $accountId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=account_id')]
    public string $accountId;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountOutcomeRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\AccountOutcomeRequest $body;

    /**
     * Opaque client key, 16 to 128 characters of [A-Za-z0-9._:-] (a UUID or ULID fits). Scoped to the workspace principal and bound to the canonical body for 24 hours. Optional: the SDK generates a UUID when you omit it and sends the same key on every retry of the call.
     *
     * @var ?string $idempotencyKey
     */
    #[NoResponseMetadata('header:style=simple,explode=false,name=Idempotency-Key')]
    public ?string $idempotencyKey = null;

    /**
     * @param  string  $accountId
     * @param  \NoResponse\Models\Shared\AccountOutcomeRequest  $body
     * @param  ?string  $idempotencyKey
     * @phpstan-pure
     */
    public function __construct(string $accountId, Shared\AccountOutcomeRequest $body, ?string $idempotencyKey = null)
    {
        $this->accountId = $accountId;
        $this->body = $body;
        $this->idempotencyKey = $idempotencyKey;
    }
}