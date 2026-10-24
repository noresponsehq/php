<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountDeletedEvent - The account.deleted event. */
class AccountDeletedEvent
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
     * Terminal for the account's assessments created at or before deleted_at in the receiving endpoint's environment: delete what you hold from them and ignore later-arriving updates of them. deleted_at is no earlier than the creation of any assessment it erased. An assessment created after it belongs to the account assessed again: keep it, even when this event arrives after it.
     *
     * @var \NoResponse\Models\Shared\AccountDeleted $data
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('data')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountDeleted')]
    public AccountDeleted $data;

    /**
     * Present, and true, only on an event sent by POST /v1/webhooks/{endpoint_id}/test: its data is a fixed example assessment, not one of the workspace's, so a receiver acknowledges it and applies nothing. Real events have no test member.
     *
     * @var ?bool $test
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('test')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $test = null;

    /**
     * Always account.deleted.
     *
     * @var string $type
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('type')]
    public string $type;

    /**
     * @param  string  $id
     * @param  string  $createdAt
     * @param  string  $type
     * @param  \NoResponse\Models\Shared\AccountDeleted  $data
     * @param  ?bool  $test
     * @phpstan-pure
     */
    public function __construct(string $id, string $createdAt, AccountDeleted $data, ?bool $test = null, string $type = 'account.deleted')
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->data = $data;
        $this->test = $test;
        $this->type = $type;
    }
}