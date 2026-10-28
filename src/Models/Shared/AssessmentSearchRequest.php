<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentSearchRequest - Search retained assessments created in [from,to), over at most 366 days. Filters use each assessment decision, rather than the current account decision. Results can change between pages. Keep the assessment version to retrieve the exact decision later. This read does not require an idempotency key. */
class AssessmentSearchRequest
{
    /**
     *
     * @var string $from
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('from')]
    public string $from;

    /**
     *
     * @var string $to
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('to')]
    public string $to;

    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id} and its /assessments. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var ?string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $accountId = null;

    /**
     * The event an assessment is made for: account_creation (a user creates an account), login (a user returns to an existing account) or purchase (a payment or a credit grant). The account's risk is reported with the decision for this flow.
     *
     * @var \NoResponse\Models\Shared\Flow|string|null $flow
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flow')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Flow|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Flow|string|null $flow = null;

    /**
     * complete: final; nothing is still running. A lane that failed or missed its 10 s deadline stays listed in incomplete_sources, and confidence is lower. partial: a recommendation exists and at least one lane is still running or did not settle (see incomplete_sources). pending: nothing usable before the deadline; no recommendation yet, poll or wait for the webhook.
     *
     * @var \NoResponse\Models\Shared\Status|string|null $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Status|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Status|string|null $status = null;

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
     * Opaque, expiring cursor bound to this environment, operation and every filter. Keep the filters unchanged.
     *
     * @var ?string $cursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('cursor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $cursor = null;

    /**
     * standard returns the consolidated risk response; detailed adds merged provider-neutral facts when the key has detailed scope. There is no raw mode.
     *
     * @var \NoResponse\Models\Shared\ResponseMode|string|null $responseMode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('response_mode')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ResponseMode|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ResponseMode|string|null $responseMode = null;

    /**
     * The decision of the assessment's latest stored revision: block when its stored risk.block is true, otherwise its recommendation. This is not the account's current decision or held-admission state. Combined with recommendation using AND.
     *
     * @var ?\NoResponse\Models\Shared\Decision $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Decision|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?Decision $decision = null;

    /**
     *
     * @var ?int $limit
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('limit')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $limit = null;

    /**
     * @param  string  $from
     * @param  string  $to
     * @param  ?string  $accountId
     * @param  \NoResponse\Models\Shared\Flow|string|null  $flow
     * @param  \NoResponse\Models\Shared\Status|string|null  $status
     * @param  \NoResponse\Models\Shared\Recommendation|string|null  $recommendation
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @param  \NoResponse\Models\Shared\ResponseMode|string|null  $responseMode
     * @param  ?\NoResponse\Models\Shared\Decision  $decision
     * @phpstan-pure
     */
    public function __construct(string $from, string $to, ?string $accountId = null, Flow|string|null $flow = null, Status|string|null $status = null, Recommendation|string|null $recommendation = null, ?string $cursor = null, ResponseMode|string|null $responseMode = null, ?Decision $decision = null, ?int $limit = 20)
    {
        $this->from = $from;
        $this->to = $to;
        $this->accountId = $accountId;
        $this->flow = $flow;
        $this->status = $status;
        $this->recommendation = $recommendation;
        $this->cursor = $cursor;
        $this->responseMode = $responseMode;
        $this->decision = $decision;
        $this->limit = $limit;
    }
}