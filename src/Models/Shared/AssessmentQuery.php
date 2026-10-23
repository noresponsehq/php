<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentQuery - POST /v1/assessments/query body. account_id travels in the body rather than the URL path so a provider value that turns out to hold personal data is not written to access logs, proxies or browser history. Read-only: no Idempotency-Key. An account with no unexpired assessments answers 200 with empty items. */
class AssessmentQuery
{
    /**
     * Your own opaque identifier for the account being checked, scoped to your tenant. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id} and its /assessments. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     * next_cursor from the previous page, unchanged. Opaque, MAC'd and bound to the tenant and account_id.
     *
     * @var ?string $cursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('cursor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $cursor = null;

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
     *
     * @var ?int $limit
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('limit')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $limit = null;

    /**
     * @param  string  $accountId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @param  ?\NoResponse\Models\Shared\ResponseMode  $responseMode
     * @phpstan-pure
     */
    public function __construct(string $accountId, ?string $cursor = null, ?ResponseMode $responseMode = null, ?int $limit = 20)
    {
        $this->accountId = $accountId;
        $this->cursor = $cursor;
        $this->responseMode = $responseMode;
        $this->limit = $limit;
    }
}