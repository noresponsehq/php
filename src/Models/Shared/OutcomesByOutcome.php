<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** OutcomesByOutcome - Current customer-reported labels, not independently established ground truth. Missing keys mean zero. Unknown is an explicit report; absent or expired feedback is unreported. */
class OutcomesByOutcome
{
    /**
     *
     * @var ?int $confirmedAbuse
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('confirmed_abuse')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $confirmedAbuse = null;

    /**
     *
     * @var ?int $accountTakeover
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_takeover')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $accountTakeover = null;

    /**
     *
     * @var ?int $chargeback
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('chargeback')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $chargeback = null;

    /**
     *
     * @var ?int $falsePositive
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('false_positive')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $falsePositive = null;

    /**
     *
     * @var ?int $legitimate
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('legitimate')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $legitimate = null;

    /**
     *
     * @var ?int $unknown
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('unknown')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $unknown = null;

    /**
     * @param  ?int  $confirmedAbuse
     * @param  ?int  $accountTakeover
     * @param  ?int  $chargeback
     * @param  ?int  $falsePositive
     * @param  ?int  $legitimate
     * @param  ?int  $unknown
     * @phpstan-pure
     */
    public function __construct(?int $confirmedAbuse = null, ?int $accountTakeover = null, ?int $chargeback = null, ?int $falsePositive = null, ?int $legitimate = null, ?int $unknown = null)
    {
        $this->confirmedAbuse = $confirmedAbuse;
        $this->accountTakeover = $accountTakeover;
        $this->chargeback = $chargeback;
        $this->falsePositive = $falsePositive;
        $this->legitimate = $legitimate;
        $this->unknown = $unknown;
    }
}