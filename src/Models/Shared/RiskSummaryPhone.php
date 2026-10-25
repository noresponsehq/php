<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class RiskSummaryPhone
{
    /**
     *
     * @var \NoResponse\Models\Shared\LineType|string|null $lineType
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('line_type')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\LineType|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public LineType|string|null $lineType = null;

    /**
     *
     * @var ?string $country
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('country')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $country = null;

    /**
     * Highest report count any source gave for the number.
     *
     * @var ?int $reportCount
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('report_count')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $reportCount = null;

    /**
     * Carrier-network metadata from privately weighted sources; not upstream provider attribution.
     *
     * @var ?string $carrier
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('carrier')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $carrier = null;

    /**
     * @param  \NoResponse\Models\Shared\LineType|string|null  $lineType
     * @param  ?string  $country
     * @param  ?int  $reportCount
     * @param  ?string  $carrier
     * @phpstan-pure
     */
    public function __construct(LineType|string|null $lineType = null, ?string $country = null, ?int $reportCount = null, ?string $carrier = null)
    {
        $this->lineType = $lineType;
        $this->country = $country;
        $this->reportCount = $reportCount;
        $this->carrier = $carrier;
    }
}