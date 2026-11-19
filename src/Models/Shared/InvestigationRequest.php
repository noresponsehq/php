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
     * @param  ?\NoResponse\Models\Shared\EnrichmentChange  $enrichment
     * @phpstan-pure
     */
    public function __construct(ScreeningDepth|string $depth, string $personId, ?EnrichmentChange $enrichment = null)
    {
        $this->depth = $depth;
        $this->personId = $personId;
        $this->enrichment = $enrichment;
    }
}