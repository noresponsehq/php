<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AttributeAgreement - How far independent sources agree on one attribute: values is the number of distinct values reported, support the tables and profiles reporting any, and agreement match (one value), partial (the most reported value holds more than half the support) or mismatch. The values themselves are not served. */
class AttributeAgreement
{
    /**
     *
     * @var \NoResponse\Models\Shared\Agreement|string $agreement
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('agreement')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Agreement|string')]
    public Agreement|string $agreement;

    /**
     *
     * @var int $values
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('values')]
    public int $values;

    /**
     *
     * @var int $support
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('support')]
    public int $support;

    /**
     * @param  \NoResponse\Models\Shared\Agreement|string  $agreement
     * @param  int  $values
     * @param  int  $support
     * @phpstan-pure
     */
    public function __construct(Agreement|string $agreement, int $values, int $support)
    {
        $this->agreement = $agreement;
        $this->values = $values;
        $this->support = $support;
    }
}