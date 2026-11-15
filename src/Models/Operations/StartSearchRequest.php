<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class StartSearchRequest
{
    /**
     * Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.
     *
     * @var string $workspaceId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=workspace_id')]
    public string $workspaceId;

    /**
     * The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404.
     *
     * @var \NoResponse\Models\Shared\KeyEnvironment|string $environment
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=environment')]
    public Shared\KeyEnvironment|string $environment;

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
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\KeyEnvironment|string  $environment
     * @param  string  $groupId
     * @param  string  $personId
     * @param  \NoResponse\Models\Shared\SearchRequest  $body
     * @param  ?string  $idempotencyKey
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, Shared\KeyEnvironment|string $environment, string $groupId, string $personId, Shared\SearchRequest $body, ?string $idempotencyKey = null)
    {
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
        $this->groupId = $groupId;
        $this->personId = $personId;
        $this->body = $body;
        $this->idempotencyKey = $idempotencyKey;
    }
}