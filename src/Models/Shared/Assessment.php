<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Assessment - One assessment of one account, as POST /v1/assessments, GET /v1/assessments/{assessment_id} and the assessment.updated webhook return it. status says whether it is final (complete), usable with a source still running (partial) or not yet usable (pending). risk and recommendation are present for complete and partial; assessment_url is present for pending. Keep the highest assessment_version. */
class Assessment
{
    /**
     * Opaque, server-assigned assessment id: 'asm_' and a 26-character Crockford base32 ULID. Unique within the tenant; another tenant's assessment id answers 404.
     *
     * @var string $assessmentId
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('assessment_id')]
    public string $assessmentId;

    /**
     * Your own opaque identifier for the account being checked, scoped to your tenant. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused, as is a JWT; a hex digest such as a SHA-256 is allowed. It travels only in request bodies.
     *
     * @var string $accountId
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     * complete: final; nothing is still running. A lane that failed or missed its 10 s deadline stays listed in incomplete_sources, and confidence is lower. partial: a recommendation exists and at least one lane is still running or did not settle (see incomplete_sources). pending: nothing usable before the deadline; no recommendation yet, poll or wait for the webhook.
     *
     * @var \NoResponse\Models\Shared\Status $status
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('status')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\Status')]
    public Status $status;

    /**
     * Ordinal confidence in the recommendation under the current policy: low, medium, high or unavailable.
     *
     * @var \NoResponse\Models\Shared\Confidence $confidence
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('confidence')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\Confidence')]
    public Confidence $confidence;

    /**
     * The lanes that did not settle, each listed once with a reason; lanes, not sources. In a detailed view a lane is listed exactly when one of its signals did not settle; a standard view carries no signals to match.
     *
     * @var array<\NoResponse\Models\Shared\IncompleteSource> $incompleteSources
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('incomplete_sources')]
    #[\Speakeasy\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\IncompleteSource>')]
    public array $incompleteSources;

    /**
     * Version of the hand-authored heuristic weights that produced the recommendation, for example 'risk-2026-10.7'. A tenant threshold override adds a +t<N> suffix, e.g. 'risk-2026-10.7+t3'.
     *
     * @var string $policyVersion
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('policy_version')]
    public string $policyVersion;

    /**
     * Monotonic revision of this assessment. 1 on the synchronous answer; each material change while the assessment is served (an async continuation settling a source, a change of recommendation, confidence or status) increments it. Expiry does not increment it: an expired assessment is gone, not revised, and the expiry webhook carries the last served version.
     *
     * @var int $assessmentVersion
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('assessment_version')]
    public int $assessmentVersion;

    /**
     * When the assessment was created. Fixed for the life of the assessment: every revision carries the same created_at.
     *
     * @var string $createdAt
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var string $updatedAt
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('updated_at')]
    public string $updatedAt;

    /**
     * After this instant the assessment is no longer served: GET /v1/assessments/{assessment_id} answers 404 and it leaves the account history. It is created_at plus your retention period at creation (default and maximum 365 days) and is fixed per record: a later revision keeps it, and a new assessment for the same account starts its own clock. If you later shorten retention, the effective expiry becomes created_at plus the shorter of the two periods.
     *
     * @var string $expiresAt
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('expires_at')]
    public string $expiresAt;

    /**
     *
     * @var \NoResponse\Models\Shared\AssessmentTiming $timing
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('timing')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssessmentTiming')]
    public AssessmentTiming $timing;

    /**
     * An optional provider correlation id, echoed back. It is not an idempotency key. Refuses an exact-shape JWT or a bare 40, 64 or 128 character hex digest; a UUID is accepted.
     *
     * @var ?string $requestId
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('request_id')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $requestId = null;

    /**
     * The recommended action: allow, step_up or review. Your application applies it.
     *
     * @var ?\NoResponse\Models\Shared\Recommendation $recommendation
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('recommendation')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\Recommendation|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?Recommendation $recommendation = null;

    /**
     * The one risk decision for this event. score is 0 (safe) to 100 (risky): the sum of the weights of the reasons that fired, clamped to 0 to 100, from hand-set versioned weights. Every answer with a recommendation carries it, and the top-level recommendation equals risk.recommendation. It names no source or provider.
     *
     * @var ?\NoResponse\Models\Shared\Risk $risk
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('risk')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\Risk|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?Risk $risk = null;

    /**
     * Detailed view only (response_mode=detailed, which needs the detailed scope): a standard answer omits signals[], and a detailed one always carries it, possibly empty. The body does not name its mode, so that rule is the serving gate's; the schema states the half it can: an answer with risk.details is a detailed view and carries signals[]. At most one signal per (type, source_id, identifier).
     *
     * @var ?array<\NoResponse\Models\Shared\Signal> $signals
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('signals')]
    #[\Speakeasy\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Signal>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $signals = null;

    /**
     * Server-relative path of the authoritative assessment, GET /v1/assessments/{assessment_id}.
     *
     * @var ?string $assessmentUrl
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('assessment_url')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $assessmentUrl = null;

    /**
     * Version of the body shape.
     *
     * @var string $schemaVersion
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('schema_version')]
    public string $schemaVersion;

    /**
     * Labels the v0 policy as hand-authored and not statistically validated.
     *
     * @var string $policyBasis
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('policy_basis')]
    public string $policyBasis;

    /**
     * @param  string  $schemaVersion
     * @param  string  $assessmentId
     * @param  string  $accountId
     * @param  \NoResponse\Models\Shared\Status  $status
     * @param  \NoResponse\Models\Shared\Confidence  $confidence
     * @param  array<\NoResponse\Models\Shared\IncompleteSource>  $incompleteSources
     * @param  string  $policyVersion
     * @param  string  $policyBasis
     * @param  int  $assessmentVersion
     * @param  string  $createdAt
     * @param  string  $updatedAt
     * @param  string  $expiresAt
     * @param  \NoResponse\Models\Shared\AssessmentTiming  $timing
     * @param  ?string  $requestId
     * @param  ?\NoResponse\Models\Shared\Recommendation  $recommendation
     * @param  ?\NoResponse\Models\Shared\Risk  $risk
     * @param  ?array<\NoResponse\Models\Shared\Signal>  $signals
     * @param  ?string  $assessmentUrl
     * @phpstan-pure
     */
    public function __construct(string $assessmentId, string $accountId, Status $status, Confidence $confidence, array $incompleteSources, string $policyVersion, int $assessmentVersion, string $createdAt, string $updatedAt, string $expiresAt, AssessmentTiming $timing, ?string $requestId = null, ?Recommendation $recommendation = null, ?Risk $risk = null, ?array $signals = null, ?string $assessmentUrl = null, string $schemaVersion = '1', string $policyBasis = 'heuristic_unvalidated')
    {
        $this->assessmentId = $assessmentId;
        $this->accountId = $accountId;
        $this->status = $status;
        $this->confidence = $confidence;
        $this->incompleteSources = $incompleteSources;
        $this->policyVersion = $policyVersion;
        $this->assessmentVersion = $assessmentVersion;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->expiresAt = $expiresAt;
        $this->timing = $timing;
        $this->requestId = $requestId;
        $this->recommendation = $recommendation;
        $this->risk = $risk;
        $this->signals = $signals;
        $this->assessmentUrl = $assessmentUrl;
        $this->schemaVersion = $schemaVersion;
        $this->policyBasis = $policyBasis;
    }
}