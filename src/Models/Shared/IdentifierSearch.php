<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** IdentifierSearch - One customer-submitted identifier. Defaults to exact comparison of the original submitted value. canonical uses the supported identifier normalisation without an ownership claim: email preserves local-part case, NFC-normalises it and lowercases the domain without removing dots or tags; phone uses international E.164 without extensions or an inferred region; username uses NFC and Unicode case folding within the customer namespace. mailbox is email-only and explicitly selects existing list rules: case-insensitive, remove +tag, and ignore local-part dots at gmail.com and googlemail.com; googlemail.com maps to gmail.com. Username requires namespace customer. Email and phone forbid namespace. Source-discovered identifiers and platform handles are not searched. Unsupported kinds, namespaces, modes and invalid values return 400. Search equality does not establish verified ownership or merge accounts. */
class IdentifierSearch
{
    /**
     *
     * @var \NoResponse\Models\Shared\IdentifierSearchKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IdentifierSearchKind|string')]
    public IdentifierSearchKind|string $kind;

    /**
     * The comparison value. Stored original identifiers remain unchanged. An invalid identifier is refused instead of returning an empty result.
     *
     * @var string $value
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('value')]
    public string $value;

    /**
     * exact compares the original submitted value; canonical uses identifier-specific normalisation; mailbox explicitly selects the email alias rules used by lists.
     *
     * @var \NoResponse\Models\Shared\MatchT|string|null $match
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('match')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\MatchT|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public MatchT|string|null $match = null;

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
     * @param  string  $value
     * @param  \NoResponse\Models\Shared\MatchT|string|null  $match
     * @param  \NoResponse\Models\Shared\NamespaceT|string|null  $namespace
     * @phpstan-pure
     */
    public function __construct(IdentifierSearchKind|string $kind, string $value, MatchT|string|null $match = null, NamespaceT|string|null $namespace = null)
    {
        $this->kind = $kind;
        $this->value = $value;
        $this->match = $match;
        $this->namespace = $namespace;
    }
}