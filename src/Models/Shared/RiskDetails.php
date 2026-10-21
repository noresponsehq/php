<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RiskDetails - Detailed view only (response_mode=detailed, which needs the detailed scope); a standard answer leaves it out. Merged observations without provider, source, origin, raw breach record, value or score. */
class RiskDetails
{
    /**
     * $phoneNames
     *
     * @var ?array<\NoResponse\Models\Shared\RiskDetailsPhoneName> $phoneNames
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('phone_names')]
    #[\Speakeasy\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\RiskDetailsPhoneName>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $phoneNames = null;

    /**
     * The matching breach tables, newest first, at most 50.
     *
     * @var ?array<\NoResponse\Models\Shared\Breach> $breaches
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('breaches')]
    #[\Speakeasy\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Breach>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $breaches = null;

    /**
     * Names found next to the identifiers in breach records, merged, with the number of distinct tables each was seen in.
     *
     * @var ?array<\NoResponse\Models\Shared\RiskDetailsBreachName> $breachNames
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('breach_names')]
    #[\Speakeasy\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\RiskDetailsBreachName>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $breachNames = null;

    /**
     * @param  ?array<\NoResponse\Models\Shared\RiskDetailsPhoneName>  $phoneNames
     * @param  ?array<\NoResponse\Models\Shared\Breach>  $breaches
     * @param  ?array<\NoResponse\Models\Shared\RiskDetailsBreachName>  $breachNames
     * @phpstan-pure
     */
    public function __construct(?array $phoneNames = null, ?array $breaches = null, ?array $breachNames = null)
    {
        $this->phoneNames = $phoneNames;
        $this->breaches = $breaches;
        $this->breachNames = $breachNames;
    }
}