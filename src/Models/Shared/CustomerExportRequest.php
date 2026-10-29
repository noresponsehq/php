<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class CustomerExportRequest
{
    /**
     *
     * @var \NoResponse\Models\Shared\CustomerExportRequestKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\CustomerExportRequestKind|string')]
    public CustomerExportRequestKind|string $kind;

    /**
     *
     * @var \NoResponse\Models\Shared\Environment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Environment|string')]
    public Environment|string $environment;

    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id} and its /assessments. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var ?string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $accountId = null;

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
     *
     * @var ?\NoResponse\Models\Shared\CustomerExportRequestFilter $filter
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('filter')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\CustomerExportRequestFilter|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?CustomerExportRequestFilter $filter = null;

    /**
     * @param  \NoResponse\Models\Shared\CustomerExportRequestKind|string  $kind
     * @param  \NoResponse\Models\Shared\Environment|string  $environment
     * @param  ?string  $accountId
     * @param  \NoResponse\Models\Shared\ResponseMode|string|null  $responseMode
     * @param  ?\NoResponse\Models\Shared\CustomerExportRequestFilter  $filter
     * @phpstan-pure
     */
    public function __construct(CustomerExportRequestKind|string $kind, Environment|string $environment, ?string $accountId = null, ResponseMode|string|null $responseMode = null, ?CustomerExportRequestFilter $filter = null)
    {
        $this->kind = $kind;
        $this->environment = $environment;
        $this->accountId = $accountId;
        $this->responseMode = $responseMode;
        $this->filter = $filter;
    }
}