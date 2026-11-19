<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** InvestigationRequest - Runs a new investigation against one retained workspace person. */
class InvestigationRequest
{
    /**
     *
     * @var \NoResponse\Models\Shared\ScreeningDepth|string $depth
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('depth')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningDepth|string')]
    public ScreeningDepth|string $depth;

    /**
     *
     * @var string $personId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('person_id')]
    public string $personId;

    /**
     * Deprecated: leave it out. Without it the investigation is a full search: every platform a connector serves in the environment when the investigation starts, which the investigation then lists, each searched only with the identifiers its connector takes. A list sent here still limits the investigation until a later contract release removes the field.
     *
     * @var ?array<string> $platforms
     * @deprecated  field: This will be removed in a future release, please migrate away from it as soon as possible.
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('platforms')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $platforms = null;

    /**
     * A change to enrichment. A field left out keeps the value in force; max_spend or deadline null removes the bound.
     *
     * @var ?\NoResponse\Models\Shared\EnrichmentChange $enrichment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('enrichment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\EnrichmentChange|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?EnrichmentChange $enrichment = null;

    /**
     * @param  \NoResponse\Models\Shared\ScreeningDepth|string  $depth
     * @param  string  $personId
     * @param  ?array<string>  $platforms
     * @param  ?\NoResponse\Models\Shared\EnrichmentChange  $enrichment
     * @phpstan-pure
     */
    public function __construct(ScreeningDepth|string $depth, string $personId, ?array $platforms = null, ?EnrichmentChange $enrichment = null)
    {
        $this->depth = $depth;
        $this->personId = $personId;
        $this->platforms = $platforms;
        $this->enrichment = $enrichment;
    }
}