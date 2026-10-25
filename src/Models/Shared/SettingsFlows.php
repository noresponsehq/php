<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class SettingsFlows
{
    /**
     * One flow's policy in force. A score below step_up is allow, below review step_up, and from review review; from block, when present, the decision is block. admission says when the flow's decision is final.
     *
     * @var \NoResponse\Models\Shared\FlowSettings $accountCreation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_creation')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FlowSettings')]
    public FlowSettings $accountCreation;

    /**
     * One flow's policy in force. A score below step_up is allow, below review step_up, and from review review; from block, when present, the decision is block. admission says when the flow's decision is final.
     *
     * @var \NoResponse\Models\Shared\FlowSettings $login
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('login')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FlowSettings')]
    public FlowSettings $login;

    /**
     * One flow's policy in force. A score below step_up is allow, below review step_up, and from review review; from block, when present, the decision is block. admission says when the flow's decision is final.
     *
     * @var \NoResponse\Models\Shared\FlowSettings $purchase
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('purchase')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FlowSettings')]
    public FlowSettings $purchase;

    /**
     * @param  \NoResponse\Models\Shared\FlowSettings  $accountCreation
     * @param  \NoResponse\Models\Shared\FlowSettings  $login
     * @param  \NoResponse\Models\Shared\FlowSettings  $purchase
     * @phpstan-pure
     */
    public function __construct(FlowSettings $accountCreation, FlowSettings $login, FlowSettings $purchase)
    {
        $this->accountCreation = $accountCreation;
        $this->login = $login;
        $this->purchase = $purchase;
    }
}