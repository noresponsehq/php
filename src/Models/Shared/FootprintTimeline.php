<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** FootprintTimeline - One identifier's dated footprint across every source: the first and last year any event was seen, the years between them, the latest year a source dated activity (omitted when none did), how many distinct sites and which kinds of evidence saw it. */
class FootprintTimeline
{
    /**
     *
     * @var int $firstSeenYear
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('first_seen_year')]
    public int $firstSeenYear;

    /**
     *
     * @var int $lastSeenYear
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('last_seen_year')]
    public int $lastSeenYear;

    /**
     *
     * @var int $spanYears
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('span_years')]
    public int $spanYears;

    /**
     *
     * @var int $sites
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('sites')]
    public int $sites;

    /**
     * $families
     *
     * @var array<\NoResponse\Models\Shared\FootprintFamily|string> $families
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('families')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\FootprintFamily|string>')]
    public array $families;

    /**
     *
     * @var ?int $lastActiveYear
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('last_active_year')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $lastActiveYear = null;

    /**
     * @param  int  $firstSeenYear
     * @param  int  $lastSeenYear
     * @param  int  $spanYears
     * @param  int  $sites
     * @param  array<\NoResponse\Models\Shared\FootprintFamily|string>  $families
     * @param  ?int  $lastActiveYear
     * @phpstan-pure
     */
    public function __construct(int $firstSeenYear, int $lastSeenYear, int $spanYears, int $sites, array $families, ?int $lastActiveYear = null)
    {
        $this->firstSeenYear = $firstSeenYear;
        $this->lastSeenYear = $lastSeenYear;
        $this->spanYears = $spanYears;
        $this->sites = $sites;
        $this->families = $families;
        $this->lastActiveYear = $lastActiveYear;
    }
}