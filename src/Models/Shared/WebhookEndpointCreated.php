<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WebhookEndpointCreated - The 201 answer of POST /v1/webhooks: the new endpoint, unverified, and its first signing secret, shown once. Store the secret where the receiver reads it, then send endpoint.verification with POST /v1/webhooks/{endpoint_id}/test. */
class WebhookEndpointCreated
{
    /**
     * One of the workspace's registered webhook endpoints. Signing secrets are not part of it: a secret is shown once, when it is issued (POST /v1/webhooks and POST /v1/webhooks/{endpoint_id}/rotate).
     *
     * @var \NoResponse\Models\Shared\WebhookEndpoint $endpoint
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('endpoint')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\WebhookEndpoint')]
    public WebhookEndpoint $endpoint;

    /**
     * A newly issued signing key with its secret, shown only in this answer. A receiver verifies NR-Webhook-Signature with the secret's UTF-8 bytes as the HMAC-SHA256 key.
     *
     * @var \NoResponse\Models\Shared\SigningSecret $signingSecret
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('signing_secret')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\SigningSecret')]
    public SigningSecret $signingSecret;

    /**
     * @param  \NoResponse\Models\Shared\WebhookEndpoint  $endpoint
     * @param  \NoResponse\Models\Shared\SigningSecret  $signingSecret
     * @phpstan-pure
     */
    public function __construct(WebhookEndpoint $endpoint, SigningSecret $signingSecret)
    {
        $this->endpoint = $endpoint;
        $this->signingSecret = $signingSecret;
    }
}