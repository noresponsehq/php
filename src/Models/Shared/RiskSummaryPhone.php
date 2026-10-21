<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class RiskSummaryPhone
{
    /**
     *
     * @var ?\NoResponse\Models\Shared\LineType $lineType
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('line_type')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\LineType|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?LineType $lineType = null;

    /**
     *
     * @var ?string $country
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('country')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $country = null;

    /**
     * Highest report count any source gave for the number.
     *
     * @var ?int $reportCount
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('report_count')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $reportCount = null;

    /**
     * Carrier-network metadata from privately weighted sources; not upstream provider attribution.
     *
     * @var ?string $carrier
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('carrier')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $carrier = null;

    /**
     * @param  ?\NoResponse\Models\Shared\LineType  $lineType
     * @param  ?string  $country
     * @param  ?int  $reportCount
     * @param  ?string  $carrier
     * @phpstan-pure
     */
    public function __construct(?LineType $lineType = null, ?string $country = null, ?int $reportCount = null, ?string $carrier = null)
    {
        $this->lineType = $lineType;
        $this->country = $country;
        $this->reportCount = $reportCount;
        $this->carrier = $carrier;
    }
}