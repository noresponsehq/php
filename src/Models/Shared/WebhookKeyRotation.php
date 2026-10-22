<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WebhookKeyRotation - The 201 answer of POST /v1/webhooks/{endpoint_id}/rotate: the new signing secret, shown once, which signs every delivery from now on, and when the key it replaced stops verifying. Until then a receiver accepts both. */
class WebhookKeyRotation
{
    /**
     * Opaque id of the endpoint registration.
     *
     * @var string $endpointId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('endpoint_id')]
    public string $endpointId;

    /**
     * A newly issued signing key with its secret, shown only in this answer. A receiver verifies NR-Webhook-Signature with the secret's UTF-8 bytes as the HMAC-SHA256 key.
     *
     * @var \NoResponse\Models\Shared\SigningSecret $signingSecret
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('signing_secret')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\SigningSecret')]
    public SigningSecret $signingSecret;

    /**
     * The key that signed until this rotation.
     *
     * @var string $previousKeyId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('previous_key_id')]
    public string $previousKeyId;

    /**
     * When the previous key stops verifying: 7 days after the rotation.
     *
     * @var string $previousKeyExpiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('previous_key_expires_at')]
    public string $previousKeyExpiresAt;

    /**
     * @param  string  $endpointId
     * @param  \NoResponse\Models\Shared\SigningSecret  $signingSecret
     * @param  string  $previousKeyId
     * @param  string  $previousKeyExpiresAt
     * @phpstan-pure
     */
    public function __construct(string $endpointId, SigningSecret $signingSecret, string $previousKeyId, string $previousKeyExpiresAt)
    {
        $this->endpointId = $endpointId;
        $this->signingSecret = $signingSecret;
        $this->previousKeyId = $previousKeyId;
        $this->previousKeyExpiresAt = $previousKeyExpiresAt;
    }
}