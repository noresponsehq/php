<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentRequest - POST /v1/assessments body. At least one of email, username or phone is required; name and ip only refine an assessment. No field carries a password, hash, token or breach value, and unknown members are refused. The email local part is kept as received and only the domain is lower-cased; the username is compared case-insensitively; the phone is strict E.164 and is assessed asynchronously. The whole body is capped at 32768 bytes. client_context holds bounded hints from the signup client; auth_context holds normalised claims from a session your backend has verified. Raw tokens are refused. */
class AssessmentRequest
{
    /**
     * Your own opaque identifier for the account being checked, scoped to your tenant. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused, as is a JWT; a hex digest such as a SHA-256 is allowed. It travels only in request bodies.
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
     * Optional tighter budget, 50 to 500 ms, measured from the moment the request reaches NoResponse. Absent means the 500 ms ceiling; a value above it is refused with 400 rather than clamped.
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
     * @param  string  $accountId
     * @param  \NoResponse\Models\Shared\AssessmentRequestIdentifiers  $identifiers
     * @param  ?\NoResponse\Models\Shared\AssessmentRequestPolicyContext  $policyContext
     * @param  ?string  $requestId
     * @param  ?int  $deadlineMs
     * @param  ?\NoResponse\Models\Shared\ResponseMode  $responseMode
     * @param  ?\NoResponse\Models\Shared\AssessmentRequestClientContext  $clientContext
     * @param  ?\NoResponse\Models\Shared\AuthContext  $authContext
     * @phpstan-pure
     */
    public function __construct(string $accountId, AssessmentRequestIdentifiers $identifiers, ?AssessmentRequestPolicyContext $policyContext = null, ?string $requestId = null, ?int $deadlineMs = null, ?ResponseMode $responseMode = null, ?AssessmentRequestClientContext $clientContext = null, ?AuthContext $authContext = null)
    {
        $this->accountId = $accountId;
        $this->identifiers = $identifiers;
        $this->policyContext = $policyContext;
        $this->requestId = $requestId;
        $this->deadlineMs = $deadlineMs;
        $this->responseMode = $responseMode;
        $this->clientContext = $clientContext;
        $this->authContext = $authContext;
    }
}