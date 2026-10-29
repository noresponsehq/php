<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PolicyPreviewRequestFlowsLogin
{
    /**
     *
     * @var ?int $stepUp
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('step_up')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $stepUp = null;

    /**
     *
     * @var ?int $review
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('review')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $review = null;

    /**
     * Send true; false is refused.
     *
     * @var ?bool $inheritsAccountCreation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('inherits_account_creation')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $inheritsAccountCreation = null;

    /**
     *
     * @var ?int $block
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('block')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $block = null;

    /**
     * @param  ?int  $stepUp
     * @param  ?int  $review
     * @param  ?bool  $inheritsAccountCreation
     * @param  ?int  $block
     * @phpstan-pure
     */
    public function __construct(?int $stepUp = null, ?int $review = null, ?bool $inheritsAccountCreation = null, ?int $block = null)
    {
        $this->stepUp = $stepUp;
        $this->review = $review;
        $this->inheritsAccountCreation = $inheritsAccountCreation;
        $this->block = $block;
    }
}