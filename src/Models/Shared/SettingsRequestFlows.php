<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** SettingsRequestFlows - Use account_creation or its deprecated alias signup, not both. */
class SettingsRequestFlows
{
    /**
     * A change to one flow. A field left out keeps the value in force. Thresholds set on login or purchase start from the values in force, account_creation's while it inherits them. After the change, 0 < step_up < review <= 100 and block is off or review <= block <= 100.
     *
     * @var ?\NoResponse\Models\Shared\FlowChange $accountCreation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_creation')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FlowChange|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?FlowChange $accountCreation = null;

    /**
     * A change to one flow. A field left out keeps the value in force. Thresholds set on login or purchase start from the values in force, account_creation's while it inherits them. After the change, 0 < step_up < review <= 100 and block is off or review <= block <= 100.
     *
     * @var ?\NoResponse\Models\Shared\FlowChange $login
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('login')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FlowChange|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?FlowChange $login = null;

    /**
     * A change to one flow. A field left out keeps the value in force. Thresholds set on login or purchase start from the values in force, account_creation's while it inherits them. After the change, 0 < step_up < review <= 100 and block is off or review <= block <= 100.
     *
     * @var ?\NoResponse\Models\Shared\FlowChange $purchase
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('purchase')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FlowChange|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?FlowChange $purchase = null;

    /**
     * A change to one flow. A field left out keeps the value in force. Thresholds set on login or purchase start from the values in force, account_creation's while it inherits them. After the change, 0 < step_up < review <= 100 and block is off or review <= block <= 100.
     *
     * @var ?\NoResponse\Models\Shared\FlowChange $signup
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('signup')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FlowChange|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?FlowChange $signup = null;

    /**
     * @param  ?\NoResponse\Models\Shared\FlowChange  $accountCreation
     * @param  ?\NoResponse\Models\Shared\FlowChange  $login
     * @param  ?\NoResponse\Models\Shared\FlowChange  $purchase
     * @param  ?\NoResponse\Models\Shared\FlowChange  $signup
     * @phpstan-pure
     */
    public function __construct(?FlowChange $accountCreation = null, ?FlowChange $login = null, ?FlowChange $purchase = null, ?FlowChange $signup = null)
    {
        $this->accountCreation = $accountCreation;
        $this->login = $login;
        $this->purchase = $purchase;
        $this->signup = $signup;
    }
}