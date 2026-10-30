<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ReviewCreateRequest
{
    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id}, its /assessments and its /linked_accounts. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     *
     * @var \NoResponse\Models\Shared\Priority|string|null $priority
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('priority')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Priority|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Priority|string|null $priority = null;

    /**
     *
     * @var ?string $assignee
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assignee')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $assignee = null;

    /**
     * @param  string  $accountId
     * @param  \NoResponse\Models\Shared\Priority|string|null  $priority
     * @param  ?string  $assignee
     * @phpstan-pure
     */
    public function __construct(string $accountId, Priority|string|null $priority = null, ?string $assignee = null)
    {
        $this->accountId = $accountId;
        $this->priority = $priority;
        $this->assignee = $assignee;
    }
}