<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** KeyRotation - The 201 answer of POST /v1/keys/rotate: the new key, shown once, and when the key that was presented stops working. The new key has the scopes and the environment of the presented key. */
class KeyRotation
{
    /**
     * The new credential, nrk_<mode>_<key id>_<secret>, in the environment of the presented key: nrk_live_ or nrk_test_. It is shown only in this answer; store it now.
     *
     * @var string $key
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('key')]
    public string $key;

    /**
     * The public id of the new key.
     *
     * @var string $keyId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('key_id')]
    public string $keyId;

    /**
     * The scopes of the new key: those of the presented key.
     *
     * @var array<\NoResponse\Models\Shared\Scope> $scopes
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('scopes')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Scope>')]
    public array $scopes;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * The id of the key that signed this request.
     *
     * @var string $previousKeyId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('previous_key_id')]
    public string $previousKeyId;

    /**
     * When the previous key stops authenticating. Until then both keys work.
     *
     * @var string $previousKeyExpiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('previous_key_expires_at')]
    public string $previousKeyExpiresAt;

    /**
     * @param  string  $key
     * @param  string  $keyId
     * @param  array<\NoResponse\Models\Shared\Scope>  $scopes
     * @param  string  $createdAt
     * @param  string  $previousKeyId
     * @param  string  $previousKeyExpiresAt
     * @phpstan-pure
     */
    public function __construct(string $key, string $keyId, array $scopes, string $createdAt, string $previousKeyId, string $previousKeyExpiresAt)
    {
        $this->key = $key;
        $this->keyId = $keyId;
        $this->scopes = $scopes;
        $this->createdAt = $createdAt;
        $this->previousKeyId = $previousKeyId;
        $this->previousKeyExpiresAt = $previousKeyExpiresAt;
    }
}