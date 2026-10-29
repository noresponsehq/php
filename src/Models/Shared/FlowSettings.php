<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** FlowSettings - One flow's policy in force. A score below step_up is allow, below review step_up, and from review review; from block, when present, the decision is block. admission says when the flow's decision is final. */
class FlowSettings
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
     * assessments only.
     *
     * @var \NoResponse\Models\Shared\UsageCountDepth|string $defaultDepth
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('default_depth')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\UsageCountDepth|string')]
    public UsageCountDepth|string $defaultDepth;

    /**
     * true while this flow has no thresholds of its own and uses account_creation's, the default for login and purchase. Always false for signup.
     *
     * @var bool $inheritsAccountCreation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('inherits_account_creation')]
    public bool $inheritsAccountCreation;

    /**
     * immediate (the default): an assessment of this flow is decided from the evidence its answer has, and later evidence may change the decision. held: while the account's current assessment of this flow has not completed, the account's decision for the flow is held, and the final decision arrives as account.risk_changed when the investigation completes or hold_seconds pass, whichever is first. Each flow has its own admission.
     *
     * @var \NoResponse\Models\Shared\Admission|string $admission
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('admission')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Admission|string')]
    public Admission|string $admission;

    /**
     * How long a held flow's assessment is held after it was created, 30 to 86400 seconds (default 300). Kept while the flow is immediate.
     *
     * @var int $holdSeconds
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('hold_seconds')]
    public int $holdSeconds;

    /**
     * The decision a held assessment takes when hold_seconds pass before its investigation completes, unless the evidence so far gives a stricter one (default review). It is announced as account.risk_changed like any other change, so an expired hold is always announced. A hosted provider hook, which cannot wait, answers a held account by it at once: deny for block, allow otherwise. Kept while the flow is immediate.
     *
     * @var \NoResponse\Models\Shared\OnExpiry|string $onExpiry
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('on_expiry')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\OnExpiry|string')]
    public OnExpiry|string $onExpiry;

    /**
     * The score from which the decision is block. Absent while blocking is off, the default.
     *
     * @var ?int $block
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('block')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $block = null;

    /**
     * @param  int  $stepUp
     * @param  int  $review
     * @param  \NoResponse\Models\Shared\UsageCountDepth|string  $defaultDepth
     * @param  bool  $inheritsAccountCreation
     * @param  \NoResponse\Models\Shared\Admission|string  $admission
     * @param  int  $holdSeconds
     * @param  \NoResponse\Models\Shared\OnExpiry|string  $onExpiry
     * @param  ?int  $block
     * @phpstan-pure
     */
    public function __construct(int $stepUp, int $review, UsageCountDepth|string $defaultDepth, bool $inheritsAccountCreation, Admission|string $admission, int $holdSeconds, OnExpiry|string $onExpiry, ?int $block = null)
    {
        $this->stepUp = $stepUp;
        $this->review = $review;
        $this->defaultDepth = $defaultDepth;
        $this->inheritsAccountCreation = $inheritsAccountCreation;
        $this->admission = $admission;
        $this->holdSeconds = $holdSeconds;
        $this->onExpiry = $onExpiry;
        $this->block = $block;
    }
}