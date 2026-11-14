<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningMatchEvidence - One identifier that ties a profile to the person. */
class ScreeningMatchEvidence
{
    /**
     * What matched. email, phone, supplied_handle and source_fact are hard identifiers; company, city and school are soft. supplied_handle is a handle on the person row; source_fact is an account a profile found by the person's lookups lists.
     *
     * @var \NoResponse\Models\Shared\ScreeningMatchEvidenceKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningMatchEvidenceKind|string')]
    public ScreeningMatchEvidenceKind|string $kind;

    /**
     * The resolver, collector or analyser that produced a record, by its catalogue name.
     *
     * @var string $resolver
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('resolver')]
    public string $resolver;

    /**
     * Where the match was seen, such as the profile field that carried it.
     *
     * @var ?string $detail
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('detail')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $detail = null;

    /**
     * @param  \NoResponse\Models\Shared\ScreeningMatchEvidenceKind|string  $kind
     * @param  string  $resolver
     * @param  ?string  $detail
     * @phpstan-pure
     */
    public function __construct(ScreeningMatchEvidenceKind|string $kind, string $resolver, ?string $detail = null)
    {
        $this->kind = $kind;
        $this->resolver = $resolver;
        $this->detail = $detail;
    }
}