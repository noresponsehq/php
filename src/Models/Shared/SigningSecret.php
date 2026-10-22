<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** SigningSecret - A newly issued signing key with its secret, shown only in this answer. A receiver verifies NR-Webhook-Signature with the secret's UTF-8 bytes as the HMAC-SHA256 key. */
class SigningSecret
{
    /**
     * The signing key id, sent as NR-Webhook-Key-Id on every delivery it signs.
     *
     * @var string $keyId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('key_id')]
    public string $keyId;

    /**
     * The signing secret: 32 random bytes as 43 characters of unpadded base64url. It is not stored in readable form or returned again.
     *
     * @var string $secret
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('secret')]
    public string $secret;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * @param  string  $keyId
     * @param  string  $secret
     * @param  string  $createdAt
     * @phpstan-pure
     */
    public function __construct(string $keyId, string $secret, string $createdAt)
    {
        $this->keyId = $keyId;
        $this->secret = $secret;
        $this->createdAt = $createdAt;
    }
}