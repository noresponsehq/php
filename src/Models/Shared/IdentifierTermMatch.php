<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** IdentifierTermMatch - One satisfied unique term in an identifier expression. term_index is the zero-based depth-first raw leaf position of its first occurrence. Duplicate normalized terms produce one witness. All satisfied unique terms are returned, ordered by term_index, including satisfied terms in an OR branch that was not needed. value preserves the original submitted value in assessment_id. In assessment scope all witnesses belong to the same matching assessment; account search chooses the newest such assessment. In account scope each term uses its newest retained matching assessment, so witnesses may have different assessment IDs. This evidence does not assert ownership or equality between accounts. */
class IdentifierTermMatch
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
     * Zero-based depth-first position of the first occurrence of this normalized term in the submitted expression.
     *
     * @var int $termIndex
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('term_index')]
    public int $termIndex;

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
     * @param  int  $termIndex
     * @param  \NoResponse\Models\Shared\NamespaceT|string|null  $namespace
     * @phpstan-pure
     */
    public function __construct(IdentifierSearchKind|string $kind, string $value, MatchT|string $matchBasis, Provenance|string $provenance, string $assessmentId, int $termIndex, NamespaceT|string|null $namespace = null)
    {
        $this->kind = $kind;
        $this->value = $value;
        $this->matchBasis = $matchBasis;
        $this->provenance = $provenance;
        $this->assessmentId = $assessmentId;
        $this->termIndex = $termIndex;
        $this->namespace = $namespace;
    }
}