<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Coverage - Counts only; a zero denominator means no eligible retained records and does not imply a zero rate. */
class Coverage
{
    /**
     *
     * @var int $numerator
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('numerator')]
    public int $numerator;

    /**
     *
     * @var int $denominator
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('denominator')]
    public int $denominator;

    /**
     * @param  int  $numerator
     * @param  int  $denominator
     * @phpstan-pure
     */
    public function __construct(int $numerator, int $denominator)
    {
        $this->numerator = $numerator;
        $this->denominator = $denominator;
    }
}