<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** SigningKey - One signing key, by id. The secret is not included. */
class SigningKey
{
    /**
     * The signing key id, sent as NR-Webhook-Key-Id on every delivery it signs.
     *
     * @var string $keyId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('key_id')]
    public string $keyId;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * Present on a key a rotation replaced: it stops verifying at this instant, 7 days after the rotation. Absent on the key that signs.
     *
     * @var ?string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $expiresAt = null;

    /**
     * @param  string  $keyId
     * @param  string  $createdAt
     * @param  ?string  $expiresAt
     * @phpstan-pure
     */
    public function __construct(string $keyId, string $createdAt, ?string $expiresAt = null)
    {
        $this->keyId = $keyId;
        $this->createdAt = $createdAt;
        $this->expiresAt = $expiresAt;
    }
}