<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** KeyRequest - POST /v1/workspaces/{workspace_id}/keys body. Creates an API key in one environment of the workspace with the scopes named, and returns its secret once. A live key needs the admin or owner role; a test key needs developer or above. An API key with the management scope creates keys in its own environment with scopes it holds itself. Each scope may appear once. */
class KeyRequest
{
    /**
     * The environment the key belongs to. A live key assesses with live sources; a test key answers from the deterministic simulator.
     *
     * @var \NoResponse\Models\Shared\KeyEnvironment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\KeyEnvironment|string')]
    public KeyEnvironment|string $environment;

    /**
     * The key's scopes, each at most once.
     *
     * @var array<\NoResponse\Models\Shared\KeyRequestScope> $scopes
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('scopes')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\KeyRequestScope>')]
    public array $scopes;

    /**
     * @param  \NoResponse\Models\Shared\KeyEnvironment|string  $environment
     * @param  array<\NoResponse\Models\Shared\KeyRequestScope>  $scopes
     * @phpstan-pure
     */
    public function __construct(KeyEnvironment|string $environment, array $scopes)
    {
        $this->environment = $environment;
        $this->scopes = $scopes;
    }
}