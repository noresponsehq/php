<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class SharedIdentifier
{
    /**
     *
     * @var \NoResponse\Models\Shared\IdentifierSearchKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IdentifierSearchKind|string')]
    public IdentifierSearchKind|string $kind;

    /**
     * exact compares the original submitted value; canonical uses identifier-specific normalisation; mailbox explicitly selects the email alias rules used by lists.
     *
     * @var \NoResponse\Models\Shared\MatchT|string $matchBasis
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('match_basis')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\MatchT|string')]
    public MatchT|string $matchBasis;

    /**
     * Customer-submitted input. It does not mean the customer or NoResponse verified ownership.
     *
     * @var \NoResponse\Models\Shared\Provenance|string $provenance
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('provenance')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Provenance|string')]
    public Provenance|string $provenance;

    /**
     *
     * @var \NoResponse\Models\Shared\IdentifierSubmission $account
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IdentifierSubmission')]
    public IdentifierSubmission $account;

    /**
     *
     * @var \NoResponse\Models\Shared\IdentifierSubmission $linkedAccount
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('linked_account')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IdentifierSubmission')]
    public IdentifierSubmission $linkedAccount;

    /**
     * Required for username: the username submitted by this customer in this workspace/environment. It does not name or join a source platform. Omit for email and phone.
     *
     * @var \NoResponse\Models\Shared\NamespaceT|string|null $namespace
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('namespace')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\NamespaceT|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public NamespaceT|string|null $namespace = null;

    /**
     * @param  \NoResponse\Models\Shared\IdentifierSearchKind|string  $kind
     * @param  \NoResponse\Models\Shared\MatchT|string  $matchBasis
     * @param  \NoResponse\Models\Shared\Provenance|string  $provenance
     * @param  \NoResponse\Models\Shared\IdentifierSubmission  $account
     * @param  \NoResponse\Models\Shared\IdentifierSubmission  $linkedAccount
     * @param  \NoResponse\Models\Shared\NamespaceT|string|null  $namespace
     * @phpstan-pure
     */
    public function __construct(IdentifierSearchKind|string $kind, MatchT|string $matchBasis, Provenance|string $provenance, IdentifierSubmission $account, IdentifierSubmission $linkedAccount, NamespaceT|string|null $namespace = null)
    {
        $this->kind = $kind;
        $this->matchBasis = $matchBasis;
        $this->provenance = $provenance;
        $this->account = $account;
        $this->linkedAccount = $linkedAccount;
        $this->namespace = $namespace;
    }
}