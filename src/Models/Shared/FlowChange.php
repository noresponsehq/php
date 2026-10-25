<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** FlowChange - A change to one flow. A field left out keeps the value in force. Thresholds set on login or purchase start from the values in force, account_creation's while it inherits them. After the change, 0 < step_up < review <= 100 and block is off or review <= block <= 100. */
class FlowChange
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
     * The depth a request for this flow that names none is served at. Defaults: full for account_creation and purchase, quick for login.
     *
     * @var \NoResponse\Models\Shared\DefaultDepth|string|null $defaultDepth
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('default_depth')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\DefaultDepth|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public DefaultDepth|string|null $defaultDepth = null;

    /**
     * Login or purchase only: drop the flow's own thresholds so it uses account_creation's again. Not combined with step_up, review or block. Send true; false is refused.
     *
     * @var ?bool $inheritsAccountCreation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('inherits_account_creation')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $inheritsAccountCreation = null;

    /**
     * Alias of inherits_account_creation, still accepted. Send true; false is refused.
     *
     * @var ?bool $inheritsSignup
     * @deprecated  field: This will be removed in a future release, please migrate away from it as soon as possible.
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('inherits_signup')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $inheritsSignup = null;

    /**
     * immediate (the default): an assessment of this flow is decided from the evidence its answer has, and later evidence may change the decision. held: while the account's current assessment of this flow has not completed, the account's decision for the flow is held, and the final decision arrives as account.risk_changed when the investigation completes or hold_seconds pass, whichever is first. Each flow has its own admission.
     *
     * @var \NoResponse\Models\Shared\Admission|string|null $admission
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('admission')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Admission|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Admission|string|null $admission = null;

    /**
     * How long a held flow's assessment is held after it was created, 30 to 86400 seconds (default 300). Kept while the flow is immediate.
     *
     * @var ?int $holdSeconds
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('hold_seconds')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $holdSeconds = null;

    /**
     * The decision a held assessment takes when hold_seconds pass before its investigation completes, unless the evidence so far gives a stricter one (default review). It is announced as account.risk_changed like any other change, so an expired hold is always announced. A hosted provider hook, which cannot wait, answers a held account by it at once: deny for block, allow otherwise. Kept while the flow is immediate.
     *
     * @var \NoResponse\Models\Shared\OnExpiry|string|null $onExpiry
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('on_expiry')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\OnExpiry|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public OnExpiry|string|null $onExpiry = null;

    /**
     * The score from which the decision is block; null turns blocking off.
     *
     * @var ?int $block
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('block')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $block = null;

    /**
     * @param  ?int  $stepUp
     * @param  ?int  $review
     * @param  \NoResponse\Models\Shared\DefaultDepth|string|null  $defaultDepth
     * @param  ?bool  $inheritsAccountCreation
     * @param  ?bool  $inheritsSignup
     * @param  \NoResponse\Models\Shared\Admission|string|null  $admission
     * @param  ?int  $holdSeconds
     * @param  \NoResponse\Models\Shared\OnExpiry|string|null  $onExpiry
     * @param  ?int  $block
     * @phpstan-pure
     */
    public function __construct(?int $stepUp = null, ?int $review = null, DefaultDepth|string|null $defaultDepth = null, ?bool $inheritsAccountCreation = null, ?bool $inheritsSignup = null, Admission|string|null $admission = null, ?int $holdSeconds = null, OnExpiry|string|null $onExpiry = null, ?int $block = null)
    {
        $this->stepUp = $stepUp;
        $this->review = $review;
        $this->defaultDepth = $defaultDepth;
        $this->inheritsAccountCreation = $inheritsAccountCreation;
        $this->inheritsSignup = $inheritsSignup;
        $this->admission = $admission;
        $this->holdSeconds = $holdSeconds;
        $this->onExpiry = $onExpiry;
        $this->block = $block;
    }
}