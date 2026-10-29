<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class AuditStream
{
    /**
     *
     * @var string $endpointId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('endpoint_id')]
    public string $endpointId;

    /**
     *
     * @var \NoResponse\Models\Shared\Environment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Environment|string')]
    public Environment|string $environment;

    /**
     * $actions
     *
     * @var array<string> $actions
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('actions')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>')]
    public array $actions;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * unverified until the endpoint echoes an endpoint.verification challenge (send one with POST /v1/webhooks/{endpoint_id}/test); verified receives assessment.updated events; disabled after 72 hours of continuous delivery failure, and verified again by the same challenge.
     *
     * @var \NoResponse\Models\Shared\WebhookEndpointState|string $endpointState
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('endpoint_state')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\WebhookEndpointState|string')]
    public WebhookEndpointState|string $endpointState;

    /**
     *
     * @var ?string $lastAttemptAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('last_attempt_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $lastAttemptAt = null;

    /**
     *
     * @var ?string $lastDeliveredAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('last_delivered_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $lastDeliveredAt = null;

    /**
     * @param  string  $endpointId
     * @param  \NoResponse\Models\Shared\Environment|string  $environment
     * @param  array<string>  $actions
     * @param  string  $createdAt
     * @param  \NoResponse\Models\Shared\WebhookEndpointState|string  $endpointState
     * @param  ?string  $lastAttemptAt
     * @param  ?string  $lastDeliveredAt
     * @phpstan-pure
     */
    public function __construct(string $endpointId, Environment|string $environment, array $actions, string $createdAt, WebhookEndpointState|string $endpointState, ?string $lastAttemptAt = null, ?string $lastDeliveredAt = null)
    {
        $this->endpointId = $endpointId;
        $this->environment = $environment;
        $this->actions = $actions;
        $this->createdAt = $createdAt;
        $this->endpointState = $endpointState;
        $this->lastAttemptAt = $lastAttemptAt;
        $this->lastDeliveredAt = $lastDeliveredAt;
    }
}