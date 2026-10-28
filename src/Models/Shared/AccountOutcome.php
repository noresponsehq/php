<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountOutcome - Immutable acceptance receipt. risk_version is the account version after this report committed, not the version when a retry reads it. effective_outcome_id names the effective head at that write. The effective expiration may shorten under retention changes. A legitimate report or correction removes only the account-feedback contribution, not unrelated risk. */
class AccountOutcome
{
    /**
     * Opaque, server-assigned id of one recorded outcome: 'out_' and a 26-character Crockford base32 ULID. Unique within the workspace.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id} and its /assessments. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     * What the provider later learned about the assessed account. confirmed_abuse, account_takeover and chargeback report abuse; false_positive and legitimate withdraw an earlier abuse report of this workspace for the assessment; unknown is recorded only. Outcomes are append-only and the latest one recorded for an assessment wins.
     *
     * @var \NoResponse\Models\Shared\Outcome|string $outcome
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('outcome')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Outcome|string')]
    public Outcome|string $outcome;

    /**
     *
     * @var string $observedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('observed_at')]
    public string $observedAt;

    /**
     *
     * @var string $receivedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('received_at')]
    public string $receivedAt;

    /**
     *
     * @var string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    public string $expiresAt;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountOutcomeActor $actor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('actor')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountOutcomeActor')]
    public AccountOutcomeActor $actor;

    /**
     *
     * @var int $riskVersionBefore
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('risk_version_before')]
    public int $riskVersionBefore;

    /**
     *
     * @var int $riskVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('risk_version')]
    public int $riskVersion;

    /**
     * Opaque, server-assigned id of one recorded outcome: 'out_' and a 26-character Crockford base32 ULID. Unique within the workspace.
     *
     * @var ?string $supersedes
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('supersedes')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $supersedes = null;

    /**
     * Your own opaque reference for the outcome, such as a case or ticket id. Stored as given and not interpreted; keep direct identifiers out of it.
     *
     * @var ?string $externalRef
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('external_ref')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $externalRef = null;

    /**
     * Opaque, server-assigned id of one recorded outcome: 'out_' and a 26-character Crockford base32 ULID. Unique within the workspace.
     *
     * @var ?string $effectiveOutcomeId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('effective_outcome_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $effectiveOutcomeId = null;

    /**
     * @param  string  $id
     * @param  string  $accountId
     * @param  \NoResponse\Models\Shared\Outcome|string  $outcome
     * @param  string  $observedAt
     * @param  string  $receivedAt
     * @param  string  $expiresAt
     * @param  \NoResponse\Models\Shared\AccountOutcomeActor  $actor
     * @param  int  $riskVersionBefore
     * @param  int  $riskVersion
     * @param  ?string  $supersedes
     * @param  ?string  $externalRef
     * @param  ?string  $effectiveOutcomeId
     * @phpstan-pure
     */
    public function __construct(string $id, string $accountId, Outcome|string $outcome, string $observedAt, string $receivedAt, string $expiresAt, AccountOutcomeActor $actor, int $riskVersionBefore, int $riskVersion, ?string $supersedes = null, ?string $externalRef = null, ?string $effectiveOutcomeId = null)
    {
        $this->id = $id;
        $this->accountId = $accountId;
        $this->outcome = $outcome;
        $this->observedAt = $observedAt;
        $this->receivedAt = $receivedAt;
        $this->expiresAt = $expiresAt;
        $this->actor = $actor;
        $this->riskVersionBefore = $riskVersionBefore;
        $this->riskVersion = $riskVersion;
        $this->supersedes = $supersedes;
        $this->externalRef = $externalRef;
        $this->effectiveOutcomeId = $effectiveOutcomeId;
    }
}