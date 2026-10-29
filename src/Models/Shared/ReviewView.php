<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ReviewView
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    public string $name;

    /**
     *
     * @var string $owner
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('owner')]
    public string $owner;

    /**
     * The credential namespace of the creator. An external user ID equal to an API-key label does not grant ownership of that key's private view.
     *
     * @var \NoResponse\Models\Shared\OwnerType|string $ownerType
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('owner_type')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\OwnerType|string')]
    public OwnerType|string $ownerType;

    /**
     *
     * @var bool $shared
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('shared')]
    public bool $shared;

    /**
     *
     * @var int $version
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('version')]
    public int $version;

    /**
     *
     * @var \NoResponse\Models\Shared\Filter $filter
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('filter')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Filter')]
    public Filter $filter;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var string $updatedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('updated_at')]
    public string $updatedAt;

    /**
     * Immutable member ID or API key ID, interpreted with owner_type. Ownership survives changes to an external user identity.
     *
     * @var string $ownerPrincipalId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('owner_principal_id')]
    public string $ownerPrincipalId;

    /**
     * @param  string  $id
     * @param  string  $name
     * @param  string  $owner
     * @param  \NoResponse\Models\Shared\OwnerType|string  $ownerType
     * @param  bool  $shared
     * @param  int  $version
     * @param  \NoResponse\Models\Shared\Filter  $filter
     * @param  string  $createdAt
     * @param  string  $updatedAt
     * @param  string  $ownerPrincipalId
     * @phpstan-pure
     */
    public function __construct(string $id, string $name, string $owner, OwnerType|string $ownerType, bool $shared, int $version, Filter $filter, string $createdAt, string $updatedAt, string $ownerPrincipalId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->owner = $owner;
        $this->ownerType = $ownerType;
        $this->shared = $shared;
        $this->version = $version;
        $this->filter = $filter;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->ownerPrincipalId = $ownerPrincipalId;
    }
}