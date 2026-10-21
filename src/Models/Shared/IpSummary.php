<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** IpSummary - Facts about the submitted IP from the offline database and this tenant's own recent assessments. Every member is optional; absent makes no claim. */
class IpSummary
{
    /**
     * ISO 3166-1 alpha-2 country of the address.
     *
     * @var ?string $country
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('country')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $country = null;

    /**
     * The address's network type.
     *
     * @var ?\NoResponse\Models\Shared\IpSummaryType $type
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('type')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\IpSummaryType|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?IpSummaryType $type = null;

    /**
     * Assessments in this tenant with the same IP in the last 24 hours, this one included. A count only.
     *
     * @var ?int $seenInTenant
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('seen_in_tenant')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $seenInTenant = null;

    /**
     * @param  ?string  $country
     * @param  ?\NoResponse\Models\Shared\IpSummaryType  $type
     * @param  ?int  $seenInTenant
     * @phpstan-pure
     */
    public function __construct(?string $country = null, ?IpSummaryType $type = null, ?int $seenInTenant = null)
    {
        $this->country = $country;
        $this->type = $type;
        $this->seenInTenant = $seenInTenant;
    }
}