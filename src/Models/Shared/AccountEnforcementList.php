<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountEnforcementList - Page through account enforcements. */
class AccountEnforcementList
{
    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id}, its /assessments and its /linked_accounts. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\Enforcement> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Enforcement>')]
    public array $items;

    /**
     * Opaque, expiring cursor bound to the workspace, environment, account and history kind. Absent at the end.
     *
     * @var ?string $nextCursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_cursor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $nextCursor = null;

    /**
     * @param  string  $accountId
     * @param  array<\NoResponse\Models\Shared\Enforcement>  $items
     * @param  ?string  $nextCursor
     * @phpstan-pure
     */
    public function __construct(string $accountId, array $items, ?string $nextCursor = null)
    {
        $this->accountId = $accountId;
        $this->items = $items;
        $this->nextCursor = $nextCursor;
    }
}