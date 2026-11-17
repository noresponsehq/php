<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** EnrichmentChange - A change to enrichment. A field left out keeps the value in force; max_spend or deadline null removes the bound. */
class EnrichmentChange
{
    /**
     * off: enrichment starts no search. suggest: enrichment starts no search by itself. automatic: after a workspace person's own investigation, and each time a search on that person finishes, enrichment starts searches by itself.
     *
     * @var \NoResponse\Models\Shared\EnrichmentMode|string|null $mode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('mode')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\EnrichmentMode|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public EnrichmentMode|string|null $mode = null;

    /**
     * Enrichment searches values only from records more likely than this to be the person's, 0 to 0.99.
     *
     * @var ?float $minLikelihood
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('min_likelihood')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?float $minLikelihood = null;

    /**
     * The kinds of value enrichment searches: distinctive usernames, and email addresses and phone numbers, which belong to one person each.
     *
     * @var ?array<\NoResponse\Models\Shared\EnrichmentChangeKind> $kinds
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kinds')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\EnrichmentChangeKind>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $kinds = null;

    /**
     * The most enrichment may spend on a person from one investigation, in minor units of USD (cents): each search it started after that investigation started counts its estimate or what it spent, whichever is more. At the bound enrichment starts nothing more for that investigation. null: only the environment's screening_daily_cap bounds it.
     *
     * @var ?int $maxSpend
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('max_spend')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $maxSpend = null;

    /**
     * How long enrichment may start searches after an investigation starts, 60 to 2592000 seconds. null: no deadline.
     *
     * @var ?int $deadline
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('deadline')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $deadline = null;

    /**
     * @param  \NoResponse\Models\Shared\EnrichmentMode|string|null  $mode
     * @param  ?float  $minLikelihood
     * @param  ?array<\NoResponse\Models\Shared\EnrichmentChangeKind>  $kinds
     * @param  ?int  $maxSpend
     * @param  ?int  $deadline
     * @phpstan-pure
     */
    public function __construct(EnrichmentMode|string|null $mode = null, ?float $minLikelihood = null, ?array $kinds = null, ?int $maxSpend = null, ?int $deadline = null)
    {
        $this->mode = $mode;
        $this->minLikelihood = $minLikelihood;
        $this->kinds = $kinds;
        $this->maxSpend = $maxSpend;
        $this->deadline = $deadline;
    }
}