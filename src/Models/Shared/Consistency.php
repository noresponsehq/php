<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Consistency - Cross-identifier agreement, computed from facts only. Every member is optional; absent makes no claim. */
class Consistency
{
    /**
     * How a submitted identifier agrees with what the evidence holds for the other identifiers. unknown is a definite 'cannot tell' (for example a truncated or too-common breach result); absent means the comparison was not made.
     *
     * @var \NoResponse\Models\Shared\ConsistencyValue|string|null $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ConsistencyValue|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ConsistencyValue|string|null $name = null;

    /**
     * How a submitted identifier agrees with what the evidence holds for the other identifiers. unknown is a definite 'cannot tell' (for example a truncated or too-common breach result); absent means the comparison was not made.
     *
     * @var \NoResponse\Models\Shared\ConsistencyValue|string|null $phone
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('phone')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ConsistencyValue|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ConsistencyValue|string|null $phone = null;

    /**
     * How a submitted identifier agrees with what the evidence holds for the other identifiers. unknown is a definite 'cannot tell' (for example a truncated or too-common breach result); absent means the comparison was not made.
     *
     * @var \NoResponse\Models\Shared\ConsistencyValue|string|null $ip
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('ip')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ConsistencyValue|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ConsistencyValue|string|null $ip = null;

    /**
     * IP country, phone country, breach countries and policy_context.region together.
     *
     * @var \NoResponse\Models\Shared\Country|string|null $country
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('country')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Country|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Country|string|null $country = null;

    /**
     * @param  \NoResponse\Models\Shared\ConsistencyValue|string|null  $name
     * @param  \NoResponse\Models\Shared\ConsistencyValue|string|null  $phone
     * @param  \NoResponse\Models\Shared\ConsistencyValue|string|null  $ip
     * @param  \NoResponse\Models\Shared\Country|string|null  $country
     * @phpstan-pure
     */
    public function __construct(ConsistencyValue|string|null $name = null, ConsistencyValue|string|null $phone = null, ConsistencyValue|string|null $ip = null, Country|string|null $country = null)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->ip = $ip;
        $this->country = $country;
    }
}