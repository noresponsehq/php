<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountDirectorySearchRequest - Bounded distinct-account search for one authenticated workspace/environment. identifier matches any retained admitted assessment of an account, including historical submitted values. email preserves the legacy canonical-mailbox filter. identifier and email cannot be combined. All other filters combine using AND. Typed identifier search uses stable opaque account order; ordinary and legacy email searches retain newest-seen ordering. Pages are live, not a cross-page snapshot. Requires history or investigate authority and identifier-read permission for identifier, identifier_expression or email filtering. identifier_expression explicitly chooses scope assessment (one whole matching submission) or account (terms may match different retained submissions of one account). At most 8 raw terms and 3 group levels. Mutually exclusive with identifier and email. Expression search uses the same stable opaque account order as typed identifier search. */
class AccountDirectorySearchRequest
{
    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id}, its /assessments and its /linked_accounts. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var ?string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $accountId = null;

    /**
     * Assessments of every account that one of its retained admitted assessments sent this mailbox as identifiers.email, matched as lists match an email entry: case-insensitive, a +tag removed and, at gmail.com and googlemail.com, the dots of the local part ignored. Only assessments stored since email list matching began carry the mailbox. An address that is not a valid mailbox is refused with 400.
     *
     * @var ?string $email
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('email')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $email = null;

    /**
     * Opaque, expiring cursor bound to workspace, environment, operation and all filters, including expression scope, ordered structure and original term values. Keep grouping, operand order, matching modes and values unchanged; an omitted match is equivalent to exact. The page limit may change.
     *
     * @var ?string $cursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('cursor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $cursor = null;

    /**
     * One customer-submitted identifier. Defaults to exact comparison of the original submitted value. canonical uses the supported identifier normalisation without an ownership claim: email preserves local-part case, NFC-normalises it and lowercases the domain without removing dots or tags; phone uses international E.164 without extensions or an inferred region; username uses NFC and Unicode case folding within the customer namespace. mailbox is email-only and explicitly selects existing list rules: case-insensitive, remove +tag, and ignore local-part dots at gmail.com and googlemail.com; googlemail.com maps to gmail.com. Username requires namespace customer. Email and phone forbid namespace. Source-discovered identifiers and platform handles are not searched. Unsupported kinds, namespaces, modes and invalid values return 400. Search equality does not establish verified ownership or merge accounts.
     *
     * @var ?\NoResponse\Models\Shared\IdentifierSearch $identifier
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('identifier')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IdentifierSearch|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?IdentifierSearch $identifier = null;

    /**
     * A bounded AND/OR expression over submitted identifiers. Required scope assessment means the entire expression must match one retained assessment. Scope account permits each term to match a different retained assessment of the same account and is accepted only by account search. Exactly one of term, and or or is allowed at every node. Groups contain 2 to 8 operands, with at most 3 nested group levels and 8 raw term occurrences over the entire expression. A root term is allowed. Duplicate terms with the same kind, match rule, namespace and normalized comparison are idempotent, but count toward the raw limit. Match rules default to exact and preserve the existing identifier contract. Only retained submitted identifiers can satisfy a term. Unknown fields, unsupported scopes and malformed or oversized expressions return 400 invalid_request.
     *
     * @var ?\NoResponse\Models\Shared\IdentifierExpression $identifierExpression
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('identifier_expression')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IdentifierExpression|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?IdentifierExpression $identifierExpression = null;

    /**
     * Select accounts with a retained open or in-progress review, or a current review/block account decision with no retained effective account outcome. The server applies this filter before counting and pagination. Requires reviews.read as well as history.read for console members; API keys additionally require management.
     *
     * @var ?bool $needsAction
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('needs_action')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $needsAction = null;

    /**
     *
     * @var ?int $limit
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('limit')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $limit = null;

    /**
     * @param  ?bool  $needsAction
     * @param  ?string  $accountId
     * @param  ?string  $email
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @param  ?\NoResponse\Models\Shared\IdentifierSearch  $identifier
     * @param  ?\NoResponse\Models\Shared\IdentifierExpression  $identifierExpression
     * @phpstan-pure
     */
    public function __construct(?string $accountId = null, ?string $email = null, ?string $cursor = null, ?IdentifierSearch $identifier = null, ?IdentifierExpression $identifierExpression = null, ?bool $needsAction = false, ?int $limit = 25)
    {
        $this->accountId = $accountId;
        $this->email = $email;
        $this->cursor = $cursor;
        $this->identifier = $identifier;
        $this->identifierExpression = $identifierExpression;
        $this->needsAction = $needsAction;
        $this->limit = $limit;
    }
}