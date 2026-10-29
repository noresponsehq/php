<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PolicyPreviewRequestFlows
{
    /**
     *
     * @var ?\NoResponse\Models\Shared\PolicyPreviewRequestFlowsAccountCreation $accountCreation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_creation')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PolicyPreviewRequestFlowsAccountCreation|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?PolicyPreviewRequestFlowsAccountCreation $accountCreation = null;

    /**
     *
     * @var ?\NoResponse\Models\Shared\PolicyPreviewRequestFlowsLogin $login
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('login')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PolicyPreviewRequestFlowsLogin|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?PolicyPreviewRequestFlowsLogin $login = null;

    /**
     *
     * @var ?\NoResponse\Models\Shared\PolicyPreviewRequestFlowsPurchase $purchase
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('purchase')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PolicyPreviewRequestFlowsPurchase|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?PolicyPreviewRequestFlowsPurchase $purchase = null;

    /**
     * @param  ?\NoResponse\Models\Shared\PolicyPreviewRequestFlowsAccountCreation  $accountCreation
     * @param  ?\NoResponse\Models\Shared\PolicyPreviewRequestFlowsLogin  $login
     * @param  ?\NoResponse\Models\Shared\PolicyPreviewRequestFlowsPurchase  $purchase
     * @phpstan-pure
     */
    public function __construct(?PolicyPreviewRequestFlowsAccountCreation $accountCreation = null, ?PolicyPreviewRequestFlowsLogin $login = null, ?PolicyPreviewRequestFlowsPurchase $purchase = null)
    {
        $this->accountCreation = $accountCreation;
        $this->login = $login;
        $this->purchase = $purchase;
    }
}