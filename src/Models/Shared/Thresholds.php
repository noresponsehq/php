<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class Thresholds
{
    /**
     *
     * @var int $stepUp
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('step_up')]
    public int $stepUp;

    /**
     *
     * @var int $review
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('review')]
    public int $review;

    /**
     *
     * @var ?int $block
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('block')]
    public ?int $block;

    /**
     * @param  int  $stepUp
     * @param  int  $review
     * @param  ?int  $block
     * @phpstan-pure
     */
    public function __construct(int $stepUp, int $review, ?int $block = null)
    {
        $this->stepUp = $stepUp;
        $this->review = $review;
        $this->block = $block;
    }
}