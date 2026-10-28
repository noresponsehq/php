<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentDetail - One assessment's own facts: its score and recommendation, the signals behind them, the lanes still running and its timing. risk here is this assessment's own score; the account's current risk is the account member of the assessment. risk and recommendation are present for complete and partial; assessment_url is present for pending. */
class AssessmentDetail
{
    /**
     * Opaque, server-assigned assessment id: 'asm_' and a 26-character Crockford base32 ULID. Unique within the workspace; another workspace's assessment id answers 404.
     *
     * @var string $assessmentId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_id')]
    public string $assessmentId;

    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id} and its /assessments. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     * complete: final; nothing is still running. A lane that failed or missed its 10 s deadline stays listed in incomplete_sources, and confidence is lower. partial: a recommendation exists and at least one lane is still running or did not settle (see incomplete_sources). pending: nothing usable before the deadline; no recommendation yet, poll or wait for the webhook.
     *
     * @var \NoResponse\Models\Shared\Status|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Status|string')]
    public Status|string $status;

    /**
     * Ordinal confidence in the recommendation under the current policy: low, medium, high or unavailable.
     *
     * @var \NoResponse\Models\Shared\Confidence|string $confidence
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('confidence')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Confidence|string')]
    public Confidence|string $confidence;

    /**
     * The lanes that did not settle, each listed once with a reason; lanes, not sources. In a detailed view a lane is listed exactly when one of its signals did not settle; a standard view carries no signals to match.
     *
     * @var array<\NoResponse\Models\Shared\IncompleteSource> $incompleteSources
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('incomplete_sources')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\IncompleteSource>')]
    public array $incompleteSources;

    /**
     * Version of the hand-authored heuristic policy that produced the recommendation, for example 'risk-2026-10.7'. A workspace threshold override adds a +t<N> suffix, e.g. 'risk-2026-10.7+t3'.
     *
     * @var string $policyVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('policy_version')]
    public string $policyVersion;

    /**
     * Monotonic revision of this assessment. 1 on the synchronous answer; each material change while the assessment is served (an async continuation settling a source, a change of recommendation, confidence or status) increments it. Expiry does not increment it: an expired assessment is gone, not revised, and the expiry webhook carries the last served version.
     *
     * @var int $assessmentVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_version')]
    public int $assessmentVersion;

    /**
     * When the assessment was created. Fixed for the life of the assessment: every revision carries the same created_at.
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
     * After this instant the assessment is no longer served: GET /v1/assessments/{assessment_id} answers 404 and it leaves the account history. It is created_at plus your retention period at creation (default and maximum 365 days) and is fixed per record: a later revision keeps it, and a new assessment for the same account starts its own clock. If you later shorten retention, the effective expiry becomes created_at plus the shorter of the two periods.
     *
     * @var string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    public string $expiresAt;

    /**
     *
     * @var \NoResponse\Models\Shared\AssessmentDetailTiming $timing
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('timing')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssessmentDetailTiming')]
    public AssessmentDetailTiming $timing;

    /**
     * The identifiers an assessment was sent: each member of the request's identifiers object exactly as received, before the server normalised it (the email domain keeps its case, the name its Unicode form). A member the request did not send is absent. NoResponse keeps them encrypted under the workspace's own key, does not index or log them, and deletes them with the assessment: on DELETE of the assessment or its account, at its expires_at, and with the workspace.
     *
     * @var ?\NoResponse\Models\Shared\SentIdentifiers $identifiers
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('identifiers')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\SentIdentifiers|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?SentIdentifiers $identifiers = null;

    /**
     * An optional provider correlation id, echoed back. It is not an idempotency key. Refuses an exact-shape JWT or a bare 40, 64 or 128 character hex digest; a UUID is accepted.
     *
     * @var ?string $requestId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('request_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $requestId = null;

    /**
     * The recommended action: allow, step_up or review. Your application applies it.
     *
     * @var \NoResponse\Models\Shared\Recommendation|string|null $recommendation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('recommendation')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Recommendation|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Recommendation|string|null $recommendation = null;

    /**
     * The one risk decision for this event. score is 0 (safe) to 100 (risky), set by the reasons that fired under a hand-set, versioned heuristic policy. Each reason carries its direction and impact band; the policy's weights are not published. Every answer with a recommendation carries it, and the top-level recommendation equals risk.recommendation. It names no source or provider.
     *
     * @var ?\NoResponse\Models\Shared\Risk $risk
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('risk')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Risk|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?Risk $risk = null;

    /**
     * Detailed view only (response_mode=detailed, which needs the detailed scope): a standard answer omits signals[], and a detailed one always carries it, possibly empty. The body does not name its mode, so that rule is the serving gate's; the schema states the half it can: an answer with risk.details is a detailed view and carries signals[]. At most one signal per (type, source_id, identifier).
     *
     * @var ?array<\NoResponse\Models\Shared\Signal> $signals
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('signals')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Signal>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $signals = null;

    /**
     * Server-relative path of the authoritative assessment, GET /v1/assessments/{assessment_id}.
     *
     * @var ?string $assessmentUrl
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_url')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $assessmentUrl = null;

    /**
     * The identity fields of the auth context the assessment was made with, echoed for the workspace's own correlation: the request's auth_context, or the one a hosted provider hook (POST /hooks/{integration_id}) built, with transport provider_hook and its hook_point. Present exactly when the request carried an auth_context, and the same on every revision of the assessment. Values are as the request or the hook sent them; tokens, timestamps, roles and scopes are not echoed, and the echo does not change the score.
     *
     * @var ?\NoResponse\Models\Shared\AssessmentDetailAuthContext $authContext
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('auth_context')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssessmentDetailAuthContext|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AssessmentDetailAuthContext $authContext = null;

    /**
     * Version of the body shape.
     *
     * @var string $schemaVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('schema_version')]
    public string $schemaVersion;

    /**
     * Labels the v0 policy as hand-authored and not statistically validated.
     *
     * @var string $policyBasis
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('policy_basis')]
    public string $policyBasis;

    /**
     * @param  string  $schemaVersion
     * @param  string  $assessmentId
     * @param  string  $accountId
     * @param  \NoResponse\Models\Shared\Status|string  $status
     * @param  \NoResponse\Models\Shared\Confidence|string  $confidence
     * @param  array<\NoResponse\Models\Shared\IncompleteSource>  $incompleteSources
     * @param  string  $policyVersion
     * @param  string  $policyBasis
     * @param  int  $assessmentVersion
     * @param  string  $createdAt
     * @param  string  $updatedAt
     * @param  string  $expiresAt
     * @param  \NoResponse\Models\Shared\AssessmentDetailTiming  $timing
     * @param  ?\NoResponse\Models\Shared\SentIdentifiers  $identifiers
     * @param  ?string  $requestId
     * @param  \NoResponse\Models\Shared\Recommendation|string|null  $recommendation
     * @param  ?\NoResponse\Models\Shared\Risk  $risk
     * @param  ?array<\NoResponse\Models\Shared\Signal>  $signals
     * @param  ?string  $assessmentUrl
     * @param  ?\NoResponse\Models\Shared\AssessmentDetailAuthContext  $authContext
     * @phpstan-pure
     */
    public function __construct(string $assessmentId, string $accountId, Status|string $status, Confidence|string $confidence, array $incompleteSources, string $policyVersion, int $assessmentVersion, string $createdAt, string $updatedAt, string $expiresAt, AssessmentDetailTiming $timing, ?SentIdentifiers $identifiers = null, ?string $requestId = null, Recommendation|string|null $recommendation = null, ?Risk $risk = null, ?array $signals = null, ?string $assessmentUrl = null, ?AssessmentDetailAuthContext $authContext = null, string $schemaVersion = '1', string $policyBasis = 'heuristic_unvalidated')
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
        $this->identifiers = $identifiers;
        $this->requestId = $requestId;
        $this->recommendation = $recommendation;
        $this->risk = $risk;
        $this->signals = $signals;
        $this->assessmentUrl = $assessmentUrl;
        $this->authContext = $authContext;
        $this->schemaVersion = $schemaVersion;
        $this->policyBasis = $policyBasis;
    }
}