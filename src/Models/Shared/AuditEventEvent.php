<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AuditEventEvent - The audit.event event. */
class AuditEventEvent
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
     * One privileged workspace action with its actor, target, outcome and time. Successful data changes commit their audit evidence atomically. Sensitive exports record access before returning bytes. Details exclude secrets and subject identifiers.
     *
     * @var \NoResponse\Models\Shared\AuditEvent $data
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('data')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AuditEvent')]
    public AuditEvent $data;

    /**
     * Present, and true, only on an event sent by POST /v1/webhooks/{endpoint_id}/test: its data is a fixed example assessment, not one of the workspace's, so a receiver acknowledges it and applies nothing. Real events have no test member.
     *
     * @var ?bool $test
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('test')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $test = null;

    /**
     * Always audit.event.
     *
     * @var string $type
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('type')]
    public string $type;

    /**
     * @param  string  $id
     * @param  string  $createdAt
     * @param  string  $type
     * @param  \NoResponse\Models\Shared\AuditEvent  $data
     * @param  ?bool  $test
     * @phpstan-pure
     */
    public function __construct(string $id, string $createdAt, AuditEvent $data, ?bool $test = null, string $type = 'audit.event')
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->data = $data;
        $this->test = $test;
        $this->type = $type;
    }
}