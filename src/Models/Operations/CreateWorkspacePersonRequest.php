<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CreateWorkspacePersonRequest
{
    /**
     *
     * @var \NoResponse\Models\Shared\WorkspacePersonRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\WorkspacePersonRequest $body;

    /**
     * Opaque request key, 16 to 128 characters. Repeating the key and request returns the same resource in its current state while it is retained. A different request with the same key answers 409. Use a new key for a deliberate new operation. Keys are scoped to the environment and operation; person searches also scope them to the group and person.
     *
     * @var ?string $idempotencyKey
     */
    #[NoResponseMetadata('header:style=simple,explode=false,name=Idempotency-Key')]
    public ?string $idempotencyKey = null;

    /**
     * @param  \NoResponse\Models\Shared\WorkspacePersonRequest  $body
     * @param  ?string  $idempotencyKey
     * @phpstan-pure
     */
    public function __construct(Shared\WorkspacePersonRequest $body, ?string $idempotencyKey = null)
    {
        $this->body = $body;
        $this->idempotencyKey = $idempotencyKey;
    }
}