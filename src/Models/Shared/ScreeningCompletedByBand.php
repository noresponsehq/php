<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningCompletedByBand - Screened attendees by the band of their most severe finding. */
class ScreeningCompletedByBand
{
    /**
     *
     * @var int $critical
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('critical')]
    public int $critical;

    /**
     *
     * @var int $high
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('high')]
    public int $high;

    /**
     *
     * @var int $moderate
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('moderate')]
    public int $moderate;

    /**
     *
     * @var int $low
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('low')]
    public int $low;

    /**
     *
     * @var int $info
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('info')]
    public int $info;

    /**
     * @param  int  $critical
     * @param  int  $high
     * @param  int  $moderate
     * @param  int  $low
     * @param  int  $info
     * @phpstan-pure
     */
    public function __construct(int $critical, int $high, int $moderate, int $low, int $info)
    {
        $this->critical = $critical;
        $this->high = $high;
        $this->moderate = $moderate;
        $this->low = $low;
        $this->info = $info;
    }
}