<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningSpend - What screening cost, in US cents, in total and per implementation. */
class ScreeningSpend
{
    /**
     * The total, in US cents.
     *
     * @var int $totalMinor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('total_minor')]
    public int $totalMinor;

    /**
     * $byImplementation
     *
     * @var array<\NoResponse\Models\Shared\ScreeningSpendLine> $byImplementation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('by_implementation')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningSpendLine>')]
    public array $byImplementation;

    /**
     * @param  int  $totalMinor
     * @param  array<\NoResponse\Models\Shared\ScreeningSpendLine>  $byImplementation
     * @phpstan-pure
     */
    public function __construct(int $totalMinor, array $byImplementation)
    {
        $this->totalMinor = $totalMinor;
        $this->byImplementation = $byImplementation;
    }
}