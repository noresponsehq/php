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
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ConsistencyValue|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?ConsistencyValue $name = null;

    /**
     * How a submitted identifier agrees with what the evidence holds for the other identifiers. unknown is a definite 'cannot tell' (for example a truncated or too-common breach result); absent means the comparison was not made.
     *
     * @var ?\NoResponse\Models\Shared\ConsistencyValue $phone
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('phone')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ConsistencyValue|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?ConsistencyValue $phone = null;

    /**
     * How a submitted identifier agrees with what the evidence holds for the other identifiers. unknown is a definite 'cannot tell' (for example a truncated or too-common breach result); absent means the comparison was not made.
     *
     * @var ?\NoResponse\Models\Shared\ConsistencyValue $ip
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('ip')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ConsistencyValue|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?ConsistencyValue $ip = null;

    /**
     * IP country, phone country, breach countries and policy_context.region together.
     *
     * @var ?\NoResponse\Models\Shared\Country $country
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('country')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Country|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
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