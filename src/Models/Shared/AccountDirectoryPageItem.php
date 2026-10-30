<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class AccountDirectoryPageItem
{
    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id}, its /assessments and its /linked_accounts. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     * Retrieve a retained assessment version with its original decision, policy, flow and depth. This response excludes the current account decision. Current retention and response-mode permissions still apply.
     *
     * @var \NoResponse\Models\Shared\AssessmentRevision $latest
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('latest')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssessmentRevision')]
    public AssessmentRevision $latest;

    /**
     * Count of admitted retained assessments belonging to this account, not just the returned page.
     *
     * @var int $assessments
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessments')]
    public int $assessments;

    /**
     * Present for needs_action searches. outcome means a current review/block decision lacks a retained effective outcome; review means a retained open or in-progress review. Both can apply.
     *
     * @var array<\NoResponse\Models\Shared\WaitingFor|string>|null $waitingFor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('waiting_for')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\WaitingFor|string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $waitingFor = null;

    /**
     * Body of the 200 answer to GET /v1/accounts/{account_id}: the one current risk of one of the calling workspace's accounts. It is the risk of the account's latest assessment that has a decision (status complete or partial), by created_at and then assessment_id, scored exactly as GET /v1/assessments/{assessment_id} scores that assessment, plus the account's own reason shared_api_key when a key issued to the account was used from many IP addresses or countries (POST /v1/key_usage/batches). Its assessments are the account's history (GET /v1/accounts/{account_id}/assessments).
     *
     * @var ?\NoResponse\Models\Shared\Account $current
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('current')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Account|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?Account $current = null;

    /**
     * Why this result matched a typed identifier search. value is the original value submitted in assessment_id. Provenance records a customer submission, not a source discovery or verified ownership. Equality is deterministic and has no inferred confidence score. An account result names its newest retained matching assessment, which can differ from latest.
     *
     * @var ?\NoResponse\Models\Shared\IdentifierMatch $matchedIdentifier
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('matched_identifier')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IdentifierMatch|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?IdentifierMatch $matchedIdentifier = null;

    /**
     * Present only for identifier_expression. All satisfied unique terms, ordered by term_index, with original submitted values and retained assessment witnesses. A duplicate normalized term appears once at its first raw leaf index. The legacy single identifier filter instead returns matched_identifier.
     *
     * @var ?array<\NoResponse\Models\Shared\IdentifierTermMatch> $matchedIdentifiers
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('matched_identifiers')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\IdentifierTermMatch>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $matchedIdentifiers = null;

    /**
     * @param  string  $accountId
     * @param  \NoResponse\Models\Shared\AssessmentRevision  $latest
     * @param  int  $assessments
     * @param  array<\NoResponse\Models\Shared\WaitingFor|string>|null  $waitingFor
     * @param  ?\NoResponse\Models\Shared\Account  $current
     * @param  ?\NoResponse\Models\Shared\IdentifierMatch  $matchedIdentifier
     * @param  ?array<\NoResponse\Models\Shared\IdentifierTermMatch>  $matchedIdentifiers
     * @phpstan-pure
     */
    public function __construct(string $accountId, AssessmentRevision $latest, int $assessments, ?array $waitingFor = null, ?Account $current = null, ?IdentifierMatch $matchedIdentifier = null, ?array $matchedIdentifiers = null)
    {
        $this->accountId = $accountId;
        $this->latest = $latest;
        $this->assessments = $assessments;
        $this->waitingFor = $waitingFor;
        $this->current = $current;
        $this->matchedIdentifier = $matchedIdentifier;
        $this->matchedIdentifiers = $matchedIdentifiers;
    }
}