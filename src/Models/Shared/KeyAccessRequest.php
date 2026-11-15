<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class KeyAccessRequest
{
    /**
     * Explicit restrictions that override scope grants. An empty list restores the access supplied by the scopes. Rotation preserves these restrictions.
     *
     * @var array<\NoResponse\Models\Shared\KeyAccessRequestDeniedAction> $deniedActions
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('denied_actions')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\KeyAccessRequestDeniedAction>')]
    public array $deniedActions;

    /**
     * @param  array<\NoResponse\Models\Shared\KeyAccessRequestDeniedAction>  $deniedActions
     * @phpstan-pure
     */
    public function __construct(array $deniedActions)
    {
        $this->deniedActions = $deniedActions;
    }
}