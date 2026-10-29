<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** IdentifierMatch - Why this result matched a typed identifier search. value is the original value submitted in assessment_id. Provenance records a customer submission, not a source discovery or verified ownership. Equality is deterministic and has no inferred confidence score. An account result names its newest retained matching assessment, which can differ from latest. */
class IdentifierMatch
{
    /**
     *
     * @var \NoResponse\Models\Shared\IdentifierSearchKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IdentifierSearchKind|string')]
    public IdentifierSearchKind|string $kind;

    /**
     *
     * @var string $value
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('value')]
    public string $value;

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
     * Opaque, server-assigned assessment id: 'asm_' and a 26-character Crockford base32 ULID. Unique within the workspace; another workspace's assessment id answers 404.
     *
     * @var string $assessmentId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_id')]
    public string $assessmentId;

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
     * @param  \NoResponse\Models\Shared\MatchT|string  $matchBasis
     * @param  \NoResponse\Models\Shared\Provenance|string  $provenance
     * @param  string  $assessmentId
     * @param  \NoResponse\Models\Shared\NamespaceT|string|null  $namespace
     * @phpstan-pure
     */
    public function __construct(IdentifierSearchKind|string $kind, string $value, MatchT|string $matchBasis, Provenance|string $provenance, string $assessmentId, NamespaceT|string|null $namespace = null)
    {
        $this->kind = $kind;
        $this->value = $value;
        $this->matchBasis = $matchBasis;
        $this->provenance = $provenance;
        $this->assessmentId = $assessmentId;
        $this->namespace = $namespace;
    }
}