<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class Cost
{
    /**
     *
     * @var float $allow
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('allow')]
    public float $allow;

    /**
     *
     * @var float $stepUp
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('step_up')]
    public float $stepUp;

    /**
     *
     * @var float $review
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('review')]
    public float $review;

    /**
     *
     * @var float $block
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('block')]
    public float $block;

    /**
     * @param  float  $allow
     * @param  float  $stepUp
     * @param  float  $review
     * @param  float  $block
     * @phpstan-pure
     */
    public function __construct(float $allow, float $stepUp, float $review, float $block)
    {
        $this->allow = $allow;
        $this->stepUp = $stepUp;
        $this->review = $review;
        $this->block = $block;
    }
}