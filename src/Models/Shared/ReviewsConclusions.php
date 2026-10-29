<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ReviewsConclusions - Current resolution of each resolved retained review; prior resolutions and reopened reviews do not count. Missing keys mean zero. These investigation conclusions are independent of account feedback. */
class ReviewsConclusions
{
    /**
     *
     * @var ?int $benign
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('benign')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $benign = null;

    /**
     *
     * @var ?int $abuse
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('abuse')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $abuse = null;

    /**
     *
     * @var ?int $inconclusive
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('inconclusive')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $inconclusive = null;

    /**
     * @param  ?int  $benign
     * @param  ?int  $abuse
     * @param  ?int  $inconclusive
     * @phpstan-pure
     */
    public function __construct(?int $benign = null, ?int $abuse = null, ?int $inconclusive = null)
    {
        $this->benign = $benign;
        $this->abuse = $abuse;
        $this->inconclusive = $inconclusive;
    }
}