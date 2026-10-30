<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentExpired - Terminal. Nothing to fetch; the consumer deletes its state for assessment_id. */
class AssessmentExpired
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
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     * The last served version: expiry is not a revision.
     *
     * @var int $assessmentVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_version')]
    public int $assessmentVersion;

    /**
     *
     * @var string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    public string $status;

    /**
     *
     * @var string $changeReason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('change_reason')]
    public string $changeReason;

    /**
     * @param  string  $assessmentId
     * @param  string  $accountId
     * @param  int  $assessmentVersion
     * @param  string  $status
     * @param  string  $changeReason
     * @phpstan-pure
     */
    public function __construct(string $assessmentId, string $accountId, int $assessmentVersion, string $status = 'expired', string $changeReason = 'expired')
    {
        $this->assessmentId = $assessmentId;
        $this->accountId = $accountId;
        $this->assessmentVersion = $assessmentVersion;
        $this->status = $status;
        $this->changeReason = $changeReason;
    }
}