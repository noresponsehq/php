<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentRequest - POST /v1/assessments body. At least one of email, username or phone is required; name and ip only refine an assessment. No field carries a password, hash, token or breach value, and unknown members are refused. The email local part is kept as received and only the domain is lower-cased; the username is compared case-insensitively; the phone is strict E.164 and is assessed asynchronously. The whole body is capped at 32768 bytes. client_context holds bounded hints from the signup client; auth_context holds normalised claims from a session your backend has verified. Raw tokens are refused. */
class AssessmentRequest
{
    /**
     * Your own opaque identifier for the account being checked, scoped to your tenant. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id} and its /assessments. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     * At least one of email, username or phone. name and ip refine the match and travel beside a lookup identifier; a body with only name or ip is refused with 400.
     *
     * @var \NoResponse\Models\Shared\AssessmentRequestIdentifiers $identifiers
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('identifiers')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssessmentRequestIdentifiers')]
    public AssessmentRequestIdentifiers $identifiers;

    /**
     * The customer event an assessment is made for: signup (a new account), login (a returning sign-in) or purchase (a payment or credit grant). The account's risk is reported with the decision for this flow.
     *
     * @var ?\NoResponse\Models\Shared\AssessmentFlow $flow
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flow')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssessmentFlow|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AssessmentFlow $flow = null;

    /**
     * How long the synchronous answer waits for sources. quick waits only for the fast sources, those that answer within 500 ms of ingress (or deadline_ms when lower); full waits for the whole budget, up to 3000 ms. Sources still running at the cut continue asynchronously and update the assessment either way.
     *
     * @var ?\NoResponse\Models\Shared\Depth $depth
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('depth')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Depth|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?Depth $depth = null;

    /**
     *
     * @var ?\NoResponse\Models\Shared\AssessmentRequestPolicyContext $policyContext
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('policy_context')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssessmentRequestPolicyContext|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AssessmentRequestPolicyContext $policyContext = null;

    /**
     * An optional provider correlation id, echoed back. It is not an idempotency key. Refuses an exact-shape JWT or a bare 40, 64 or 128 character hex digest; a UUID is accepted.
     *
     * @var ?string $requestId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('request_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $requestId = null;

    /**
     * Optional tighter budget, 50 to 3000 ms, measured from the moment the request reaches NoResponse. Absent means the 3000 ms ceiling; a value above it is refused with 400 rather than clamped.
     *
     * @var ?int $deadlineMs
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('deadline_ms')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $deadlineMs = null;

    /**
     * standard returns the consolidated risk response; detailed adds merged provider-neutral facts when the key has detailed scope. There is no raw mode.
     *
     * @var ?\NoResponse\Models\Shared\ResponseMode $responseMode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('response_mode')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ResponseMode|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?ResponseMode $responseMode = null;

    /**
     * Optional context observed by your signup client. The server parses these hints into coarse features, leaves raw user_agent and opaque ids out of every answer, and weighs a mismatch with the other evidence.
     *
     * @var ?\NoResponse\Models\Shared\AssessmentRequestClientContext $clientContext
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('client_context')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssessmentRequestClientContext|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AssessmentRequestClientContext $clientContext = null;

    /**
     * Normalised claims from a session your backend has already verified with WorkOS, Clerk, Auth0 or any OIDC provider. Pass the output of the SDK's auth adapters, not a raw token.
     *
     * @var ?\NoResponse\Models\Shared\AuthContext $authContext
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('auth_context')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AuthContext|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AuthContext $authContext = null;

    /**
     * Optional. When the signup gate issues an API key to the new account, send SHA-256 of that key, so later usage of the key, or a leaked copy, ties back to this assessment. Each SDK has a helper that computes it. Send only the hash: customer keys are high-entropy, so the hash reveals nothing about them. The assessment stores it, and no response, webhook or log carries it.
     *
     * @var ?\NoResponse\Models\Shared\AssessmentRequestIssuedCredential $issuedCredential
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('issued_credential')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssessmentRequestIssuedCredential|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AssessmentRequestIssuedCredential $issuedCredential = null;

    /**
     * @param  string  $accountId
     * @param  \NoResponse\Models\Shared\AssessmentRequestIdentifiers  $identifiers
     * @param  ?\NoResponse\Models\Shared\AssessmentFlow  $flow
     * @param  ?\NoResponse\Models\Shared\Depth  $depth
     * @param  ?\NoResponse\Models\Shared\AssessmentRequestPolicyContext  $policyContext
     * @param  ?string  $requestId
     * @param  ?int  $deadlineMs
     * @param  ?\NoResponse\Models\Shared\ResponseMode  $responseMode
     * @param  ?\NoResponse\Models\Shared\AssessmentRequestClientContext  $clientContext
     * @param  ?\NoResponse\Models\Shared\AuthContext  $authContext
     * @param  ?\NoResponse\Models\Shared\AssessmentRequestIssuedCredential  $issuedCredential
     * @phpstan-pure
     */
    public function __construct(string $accountId, AssessmentRequestIdentifiers $identifiers, ?AssessmentFlow $flow = null, ?Depth $depth = null, ?AssessmentRequestPolicyContext $policyContext = null, ?string $requestId = null, ?int $deadlineMs = null, ?ResponseMode $responseMode = null, ?AssessmentRequestClientContext $clientContext = null, ?AuthContext $authContext = null, ?AssessmentRequestIssuedCredential $issuedCredential = null)
    {
        $this->accountId = $accountId;
        $this->identifiers = $identifiers;
        $this->flow = $flow;
        $this->depth = $depth;
        $this->policyContext = $policyContext;
        $this->requestId = $requestId;
        $this->deadlineMs = $deadlineMs;
        $this->responseMode = $responseMode;
        $this->clientContext = $clientContext;
        $this->authContext = $authContext;
        $this->issuedCredential = $issuedCredential;
    }
}