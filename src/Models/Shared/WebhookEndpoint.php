<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WebhookEndpoint - One of the workspace's registered webhook endpoints. Signing secrets are not part of it: a secret is shown once, when it is issued (POST /v1/webhooks and POST /v1/webhooks/{endpoint_id}/rotate). */
class WebhookEndpoint
{
    /**
     * Opaque id of the endpoint registration.
     *
     * @var string $endpointId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('endpoint_id')]
    public string $endpointId;

    /**
     * The destination URL, as registered.
     *
     * @var string $url
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('url')]
    public string $url;

    /**
     * unverified until the endpoint echoes an endpoint.verification challenge (send one with POST /v1/webhooks/{endpoint_id}/test); verified receives assessment.updated events; disabled after 72 hours of continuous delivery failure, and verified again by the same challenge.
     *
     * @var \NoResponse\Models\Shared\WebhookEndpointState $state
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('state')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\WebhookEndpointState')]
    public WebhookEndpointState $state;

    /**
     * standard returns the consolidated risk response; detailed adds merged provider-neutral facts when the key has detailed scope. There is no raw mode.
     *
     * @var \NoResponse\Models\Shared\ResponseMode $responseMode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('response_mode')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ResponseMode')]
    public ResponseMode $responseMode;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * The keys a receiver may see in NR-Webhook-Key-Id, oldest first. The last one signs every new delivery; an older one keeps verifying until its expires_at.
     *
     * @var array<\NoResponse\Models\Shared\SigningKey> $signingKeys
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('signing_keys')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\SigningKey>')]
    public array $signingKeys;

    /**
     * When the endpoint last echoed a challenge. Absent until it first does.
     *
     * @var ?string $verifiedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('verified_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $verifiedAt = null;

    /**
     * @param  string  $endpointId
     * @param  string  $url
     * @param  \NoResponse\Models\Shared\WebhookEndpointState  $state
     * @param  \NoResponse\Models\Shared\ResponseMode  $responseMode
     * @param  string  $createdAt
     * @param  array<\NoResponse\Models\Shared\SigningKey>  $signingKeys
     * @param  ?string  $verifiedAt
     * @phpstan-pure
     */
    public function __construct(string $endpointId, string $url, WebhookEndpointState $state, ResponseMode $responseMode, string $createdAt, array $signingKeys, ?string $verifiedAt = null)
    {
        $this->endpointId = $endpointId;
        $this->url = $url;
        $this->state = $state;
        $this->responseMode = $responseMode;
        $this->createdAt = $createdAt;
        $this->signingKeys = $signingKeys;
        $this->verifiedAt = $verifiedAt;
    }
}