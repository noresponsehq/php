<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** CredentialAssociation - An association between an account and an issued key. The response excludes the key and its hash. Retirement removes this association from risk calculations; revoke the actual key through your own service. */
class CredentialAssociation
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id}, its /assessments and its /linked_accounts. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var \NoResponse\Models\Shared\CredentialAssociationActor $actor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('actor')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\CredentialAssociationActor')]
    public CredentialAssociationActor $actor;

    /**
     *
     * @var ?string $retiredAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('retired_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $retiredAt = null;

    /**
     *
     * @var ?\NoResponse\Models\Shared\CredentialAssociationRetiredBy $retiredBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('retired_by')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\CredentialAssociationRetiredBy|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?CredentialAssociationRetiredBy $retiredBy = null;

    /**
     * @param  string  $id
     * @param  string  $accountId
     * @param  string  $createdAt
     * @param  \NoResponse\Models\Shared\CredentialAssociationActor  $actor
     * @param  ?string  $retiredAt
     * @param  ?\NoResponse\Models\Shared\CredentialAssociationRetiredBy  $retiredBy
     * @phpstan-pure
     */
    public function __construct(string $id, string $accountId, string $createdAt, CredentialAssociationActor $actor, ?string $retiredAt = null, ?CredentialAssociationRetiredBy $retiredBy = null)
    {
        $this->id = $id;
        $this->accountId = $accountId;
        $this->createdAt = $createdAt;
        $this->actor = $actor;
        $this->retiredAt = $retiredAt;
        $this->retiredBy = $retiredBy;
    }
}