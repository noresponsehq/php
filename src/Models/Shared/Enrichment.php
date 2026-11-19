<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Enrichment - How enrichment searches the values that a workspace person's own investigation (POST /v1/investigations) and a group's screening find. Defaults: mode automatic, min_likelihood 0.5, kinds username, max_spend null and deadline null. Group screening follows the same setting, but takes mode suggest while the workspace has not set a mode. An investigation request may override each field for that investigation. A change applies to the next search enrichment starts, investigations already run included. Enrichment also keeps to limits of its own: each value once per person (once more if that search failed), at most 5 searches from one search's records, 20 per person and 6 searches deep. */
class Enrichment
{
    /**
     * off: enrichment starts no search and suggests none. suggest: enrichment starts no search by itself, and the person report lists the searches it would start in suggested_searches. automatic: after a workspace person's own investigation or a group's screening, and each time a search on that person finishes, enrichment starts searches by itself. A group takes suggest while the workspace has not set a mode.
     *
     * @var \NoResponse\Models\Shared\EnrichmentMode|string $mode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('mode')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\EnrichmentMode|string')]
    public EnrichmentMode|string $mode;

    /**
     * Enrichment searches values only from records more likely than this to be the person's, 0 to 0.99.
     *
     * @var float $minLikelihood
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('min_likelihood')]
    public float $minLikelihood;

    /**
     * The kinds of value enrichment searches: distinctive usernames, email addresses and phone numbers, which belong to one person each, and distinctive person names, searched in the breach data.
     *
     * @var array<\NoResponse\Models\Shared\EnrichmentKind|string> $kinds
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kinds')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\EnrichmentKind|string>')]
    public array $kinds;

    /**
     * The most enrichment may spend on a person from one investigation, in minor units of USD (cents): each search it started after that investigation started counts its estimate or what it spent, whichever is more. At the bound enrichment starts nothing more for that investigation. null: only the environment's screening_daily_cap bounds it.
     *
     * @var ?int $maxSpend
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('max_spend')]
    public ?int $maxSpend;

    /**
     * How long enrichment may start searches after an investigation starts, 60 to 2592000 seconds. null: no deadline.
     *
     * @var ?int $deadline
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('deadline')]
    public ?int $deadline;

    /**
     * @param  \NoResponse\Models\Shared\EnrichmentMode|string  $mode
     * @param  float  $minLikelihood
     * @param  array<\NoResponse\Models\Shared\EnrichmentKind|string>  $kinds
     * @param  ?int  $maxSpend
     * @param  ?int  $deadline
     * @phpstan-pure
     */
    public function __construct(EnrichmentMode|string $mode, float $minLikelihood, array $kinds, ?int $maxSpend = null, ?int $deadline = null)
    {
        $this->mode = $mode;
        $this->minLikelihood = $minLikelihood;
        $this->kinds = $kinds;
        $this->maxSpend = $maxSpend;
        $this->deadline = $deadline;
    }
}