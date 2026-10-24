<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountRiskChangedEvent - The account.risk_changed event. */
class AccountRiskChangedEvent
{
    /**
     * The event id, equal to the NR-Webhook-Id header and across redeliveries and every endpoint the event fans out to.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * When the event was created. Equal across redeliveries; the signing timestamp header is per delivery.
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * The account's decision for at least one flow changed. account is the account as GET /v1/accounts/{account_id} answers it for the revision that made the change: its new score, decision, reasons and decisions_by_flow, and the assessment the risk comes from. previous_decisions_by_flow are the decisions it replaced, so account.decisions_by_flow differs from them for at least one flow. On the account's first decision, previous_decisions_by_flow is allow for every flow. Events of one account are not ordered: account.risk_version orders them, so keep the account with the highest risk_version and ignore an event whose account is older than the one held.
     *
     * @var \NoResponse\Models\Shared\AccountRiskChanged $data
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('data')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountRiskChanged')]
    public AccountRiskChanged $data;

    /**
     * Present, and true, only on an event sent by POST /v1/webhooks/{endpoint_id}/test: its data is a fixed example assessment, not one of the workspace's, so a receiver acknowledges it and applies nothing. Real events have no test member.
     *
     * @var ?bool $test
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('test')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $test = null;

    /**
     * Always account.risk_changed.
     *
     * @var string $type
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('type')]
    public string $type;

    /**
     * @param  string  $id
     * @param  string  $createdAt
     * @param  string  $type
     * @param  \NoResponse\Models\Shared\AccountRiskChanged  $data
     * @param  ?bool  $test
     * @phpstan-pure
     */
    public function __construct(string $id, string $createdAt, AccountRiskChanged $data, ?bool $test = null, string $type = 'account.risk_changed')
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->data = $data;
        $this->test = $test;
        $this->type = $type;
    }
}