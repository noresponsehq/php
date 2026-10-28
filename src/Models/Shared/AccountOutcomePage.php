<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountOutcomePage - List retained account reports, newest first. The page-level effective outcome id names the current report. Each receipt preserves the effective report and risk version from its original write. Page with the returned cursor. */
class AccountOutcomePage
{
    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id} and its /assessments. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\AccountOutcome> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AccountOutcome>')]
    public array $items;

    /**
     * Opaque, expiring cursor bound to this environment, operation and every filter. Keep the filters unchanged.
     *
     * @var ?string $nextCursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_cursor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $nextCursor = null;

    /**
     * Opaque, server-assigned id of one recorded outcome: 'out_' and a 26-character Crockford base32 ULID. Unique within the workspace.
     *
     * @var ?string $effectiveOutcomeId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('effective_outcome_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $effectiveOutcomeId = null;

    /**
     * @param  string  $accountId
     * @param  array<\NoResponse\Models\Shared\AccountOutcome>  $items
     * @param  ?string  $nextCursor
     * @param  ?string  $effectiveOutcomeId
     * @phpstan-pure
     */
    public function __construct(string $accountId, array $items, ?string $nextCursor = null, ?string $effectiveOutcomeId = null)
    {
        $this->accountId = $accountId;
        $this->items = $items;
        $this->nextCursor = $nextCursor;
        $this->effectiveOutcomeId = $effectiveOutcomeId;
    }
}