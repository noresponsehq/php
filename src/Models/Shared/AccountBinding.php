<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountBinding - Binding appends an assessment revision and preserves earlier versions. Continuations use the same assessment. Erasing either the provisional or canonical name erases the canonical account, including the bound assessment. */
class AccountBinding
{
    /**
     * Opaque, server-assigned assessment id: 'asm_' and a 26-character Crockford base32 ULID. Unique within the workspace; another workspace's assessment id answers 404.
     *
     * @var string $assessmentId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_id')]
    public string $assessmentId;

    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id}, its /assessments and its /linked_accounts. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var string $provisionalAccountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('provisional_account_id')]
    public string $provisionalAccountId;

    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id}, its /assessments and its /linked_accounts. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     * Monotonic revision of this assessment. 1 on the synchronous answer; each material change while the assessment is served (an async continuation settling a source, a change of recommendation, confidence or status) increments it. Expiry does not increment it: an expired assessment is gone, not revised, and the expiry webhook carries the last served version.
     *
     * @var int $assessmentVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_version')]
    public int $assessmentVersion;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountBindingActor $actor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('actor')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountBindingActor')]
    public AccountBindingActor $actor;

    /**
     * @param  string  $assessmentId
     * @param  string  $provisionalAccountId
     * @param  string  $accountId
     * @param  int  $assessmentVersion
     * @param  string  $createdAt
     * @param  \NoResponse\Models\Shared\AccountBindingActor  $actor
     * @phpstan-pure
     */
    public function __construct(string $assessmentId, string $provisionalAccountId, string $accountId, int $assessmentVersion, string $createdAt, AccountBindingActor $actor)
    {
        $this->assessmentId = $assessmentId;
        $this->provisionalAccountId = $provisionalAccountId;
        $this->accountId = $accountId;
        $this->assessmentVersion = $assessmentVersion;
        $this->createdAt = $createdAt;
        $this->actor = $actor;
    }
}