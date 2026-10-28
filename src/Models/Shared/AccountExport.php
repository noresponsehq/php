<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountExport - Retrieve one consistent snapshot of retained customer-accessible records, including assessment revisions, account decisions, feedback, key associations, enforcements and request diagnostics. Secrets, restricted source information, other customers' data and legacy free-text notes are excluded. The same standard/detailed permissions apply. An export exceeding 10000 records or 8 MiB returns export_too_large without a partial result. Historical decisions that were not captured are identified as an exclusion. */
class AccountExport
{
    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id} and its /assessments. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     *
     * @var string $exportedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('exported_at')]
    public string $exportedAt;

    /**
     *
     * @var int $currentRiskVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('current_risk_version')]
    public int $currentRiskVersion;

    /**
     * $assessments
     *
     * @var array<\NoResponse\Models\Shared\AssessmentRevision> $assessments
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessments')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AssessmentRevision>')]
    public array $assessments;

    /**
     * $decisions
     *
     * @var array<\NoResponse\Models\Shared\AccountDecisionSnapshot> $decisions
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decisions')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AccountDecisionSnapshot>')]
    public array $decisions;

    /**
     * $outcomes
     *
     * @var array<\NoResponse\Models\Shared\AccountOutcome> $outcomes
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('outcomes')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AccountOutcome>')]
    public array $outcomes;

    /**
     * $assessmentOutcomes
     *
     * @var array<\NoResponse\Models\Shared\ExportAssessmentOutcome> $assessmentOutcomes
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_outcomes')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ExportAssessmentOutcome>')]
    public array $assessmentOutcomes;

    /**
     * $credentials
     *
     * @var array<\NoResponse\Models\Shared\CredentialAssociation> $credentials
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('credentials')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\CredentialAssociation>')]
    public array $credentials;

    /**
     * $bindings
     *
     * @var array<\NoResponse\Models\Shared\AccountBinding> $bindings
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('bindings')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AccountBinding>')]
    public array $bindings;

    /**
     * $enforcements
     *
     * @var array<\NoResponse\Models\Shared\Enforcement> $enforcements
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('enforcements')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Enforcement>')]
    public array $enforcements;

    /**
     * $requests
     *
     * @var array<\NoResponse\Models\Shared\RequestDiagnostic> $requests
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('requests')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\RequestDiagnostic>')]
    public array $requests;

    /**
     * $exclusions
     *
     * @var array<\NoResponse\Models\Shared\Exclusion|string> $exclusions
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('exclusions')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Exclusion|string>')]
    public array $exclusions;

    /**
     * Version of the body shape.
     *
     * @var string $schemaVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('schema_version')]
    public string $schemaVersion;

    /**
     *
     * @var bool $complete
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('complete')]
    public bool $complete;

    /**
     * @param  string  $schemaVersion
     * @param  string  $accountId
     * @param  string  $exportedAt
     * @param  bool  $complete
     * @param  int  $currentRiskVersion
     * @param  array<\NoResponse\Models\Shared\AssessmentRevision>  $assessments
     * @param  array<\NoResponse\Models\Shared\AccountDecisionSnapshot>  $decisions
     * @param  array<\NoResponse\Models\Shared\AccountOutcome>  $outcomes
     * @param  array<\NoResponse\Models\Shared\ExportAssessmentOutcome>  $assessmentOutcomes
     * @param  array<\NoResponse\Models\Shared\CredentialAssociation>  $credentials
     * @param  array<\NoResponse\Models\Shared\AccountBinding>  $bindings
     * @param  array<\NoResponse\Models\Shared\Enforcement>  $enforcements
     * @param  array<\NoResponse\Models\Shared\RequestDiagnostic>  $requests
     * @param  array<\NoResponse\Models\Shared\Exclusion|string>  $exclusions
     * @phpstan-pure
     */
    public function __construct(string $accountId, string $exportedAt, int $currentRiskVersion, array $assessments, array $decisions, array $outcomes, array $assessmentOutcomes, array $credentials, array $bindings, array $enforcements, array $requests, array $exclusions, string $schemaVersion = '1', bool $complete = true)
    {
        $this->accountId = $accountId;
        $this->exportedAt = $exportedAt;
        $this->currentRiskVersion = $currentRiskVersion;
        $this->assessments = $assessments;
        $this->decisions = $decisions;
        $this->outcomes = $outcomes;
        $this->assessmentOutcomes = $assessmentOutcomes;
        $this->credentials = $credentials;
        $this->bindings = $bindings;
        $this->enforcements = $enforcements;
        $this->requests = $requests;
        $this->exclusions = $exclusions;
        $this->schemaVersion = $schemaVersion;
        $this->complete = $complete;
    }
}