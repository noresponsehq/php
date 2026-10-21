<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentQuery - POST /v1/assessments/query body. account_id travels in the body rather than the URL path so a provider value that turns out to hold personal data is not written to access logs, proxies or browser history. Read-only: no Idempotency-Key. An account with no unexpired assessments answers 200 with empty items. */
class AssessmentQuery
{
    /**
     * Your own opaque identifier for the account being checked, scoped to your tenant. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused, as is a JWT; a hex digest such as a SHA-256 is allowed. It travels only in request bodies.
     *
     * @var string $accountId
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     * next_cursor from the previous page, unchanged. Opaque, MAC'd and bound to the tenant and account_id.
     *
     * @var ?string $cursor
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('cursor')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $cursor = null;

    /**
     * standard returns the consolidated risk response; detailed adds merged provider-neutral facts when the key has detailed scope. There is no raw mode.
     *
     * @var ?\NoResponse\Models\Shared\ResponseMode $responseMode
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('response_mode')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\ResponseMode|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?ResponseMode $responseMode = null;

    /**
     *
     * @var ?int $limit
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('limit')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
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