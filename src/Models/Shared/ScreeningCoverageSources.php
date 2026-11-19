<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningCoverageSources - How many sources this search asked and how many answered, across the lookup stage (sources asked whether an account exists for an identifier) and the platform stage (profiles read on each platform). A source that answered may have found nothing; one that did not answer failed or ran out of time. */
class ScreeningCoverageSources
{
    /**
     * Lookup sources plus platforms asked.
     *
     * @var int $asked
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('asked')]
    public int $asked;

    /**
     * Lookup sources plus platforms that answered.
     *
     * @var int $answered
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('answered')]
    public int $answered;

    /**
     *
     * @var \NoResponse\Models\Shared\SourceCount $lookups
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('lookups')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\SourceCount')]
    public SourceCount $lookups;

    /**
     *
     * @var \NoResponse\Models\Shared\SourceCount $platforms
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('platforms')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\SourceCount')]
    public SourceCount $platforms;

    /**
     * @param  int  $asked
     * @param  int  $answered
     * @param  \NoResponse\Models\Shared\SourceCount  $lookups
     * @param  \NoResponse\Models\Shared\SourceCount  $platforms
     * @phpstan-pure
     */
    public function __construct(int $asked, int $answered, SourceCount $lookups, SourceCount $platforms)
    {
        $this->asked = $asked;
        $this->answered = $answered;
        $this->lookups = $lookups;
        $this->platforms = $platforms;
    }
}