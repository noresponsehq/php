<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Consistency - Cross-identifier agreement, computed from facts only. Every member is optional; absent makes no claim. */
class Consistency
{
    /**
     * How a submitted identifier agrees with what the evidence holds for the other identifiers. unknown is a definite 'cannot tell' (for example a truncated or too-common breach result); absent means the comparison was not made.
     *
     * @var ?\NoResponse\Models\Shared\ConsistencyValue $name
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('name')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\ConsistencyValue|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?ConsistencyValue $name = null;

    /**
     * How a submitted identifier agrees with what the evidence holds for the other identifiers. unknown is a definite 'cannot tell' (for example a truncated or too-common breach result); absent means the comparison was not made.
     *
     * @var ?\NoResponse\Models\Shared\ConsistencyValue $phone
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('phone')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\ConsistencyValue|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?ConsistencyValue $phone = null;

    /**
     * How a submitted identifier agrees with what the evidence holds for the other identifiers. unknown is a definite 'cannot tell' (for example a truncated or too-common breach result); absent means the comparison was not made.
     *
     * @var ?\NoResponse\Models\Shared\ConsistencyValue $ip
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('ip')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\ConsistencyValue|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?ConsistencyValue $ip = null;

    /**
     * IP country, phone country, breach countries and policy_context.region together.
     *
     * @var ?\NoResponse\Models\Shared\Country $country
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('country')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\Country|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?Country $country = null;

    /**
     * @param  ?\NoResponse\Models\Shared\ConsistencyValue  $name
     * @param  ?\NoResponse\Models\Shared\ConsistencyValue  $phone
     * @param  ?\NoResponse\Models\Shared\ConsistencyValue  $ip
     * @param  ?\NoResponse\Models\Shared\Country  $country
     * @phpstan-pure
     */
    public function __construct(?ConsistencyValue $name = null, ?ConsistencyValue $phone = null, ?ConsistencyValue $ip = null, ?Country $country = null)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->ip = $ip;
        $this->country = $country;
    }
}