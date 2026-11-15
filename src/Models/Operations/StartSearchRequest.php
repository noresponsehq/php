<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class StartSearchRequest
{
    /**
     *
     * @var string $groupId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=group_id')]
    public string $groupId;

    /**
     *
     * @var string $personId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=person_id')]
    public string $personId;

    /**
     *
     * @var \NoResponse\Models\Shared\SearchRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\SearchRequest $body;

    /**
     * Opaque request key, 16 to 128 characters. Repeating the key and request returns the same resource in its current state while it is retained. A different request with the same key answers 409. Use a new key for a deliberate new operation. Keys are scoped to the environment and operation; person searches also scope them to the group and person.
     *
     * @var ?string $idempotencyKey
     */
    #[NoResponseMetadata('header:style=simple,explode=false,name=Idempotency-Key')]
    public ?string $idempotencyKey = null;

    /**
     * @param  string  $groupId
     * @param  string  $personId
     * @param  \NoResponse\Models\Shared\SearchRequest  $body
     * @param  ?string  $idempotencyKey
     * @phpstan-pure
     */
    public function __construct(string $groupId, string $personId, Shared\SearchRequest $body, ?string $idempotencyKey = null)
    {
        $this->groupId = $groupId;
        $this->personId = $personId;
        $this->body = $body;
        $this->idempotencyKey = $idempotencyKey;
    }
}