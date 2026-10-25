<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Key - One API key of your workspace. A key belongs to exactly one environment. key, the secret credential, is present only in the answer that created the key: NoResponse keeps a peppered digest of it, so store it now. Every other field is safe to show. */
class Key
{
    /**
     * The key's public id, a 26-character ULID.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * The workspace id, which is also its live environment's workspace id; the test environment's is the same id with :test appended. A workspace created through the API is tnt_ and a 26-character ULID.
     *
     * @var string $workspaceId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('workspace_id')]
    public string $workspaceId;

    /**
     * The environment the key belongs to. A live key assesses with live sources; a test key answers from the deterministic simulator.
     *
     * @var \NoResponse\Models\Shared\KeyEnvironment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\KeyEnvironment|string')]
    public KeyEnvironment|string $environment;

    /**
     * The public start of the credential, nrk_<environment>_<key id>, which identifies the key in logs and secret stores without its secret.
     *
     * @var string $prefix
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('prefix')]
    public string $prefix;

    /**
     * The key's scopes, each at most once.
     *
     * @var array<\NoResponse\Models\Shared\KeyScope|string> $scopes
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('scopes')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\KeyScope|string>')]
    public array $scopes;

    /**
     * active: the key authenticates. expired: a rotation's overlap window has ended (expires_at). revoked: the key was revoked (revoked_at) and answers 401.
     *
     * @var \NoResponse\Models\Shared\KeyStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\KeyStatus|string')]
    public KeyStatus|string $status;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * The external user id of the member who created the key through the console, or the prefix (nrk_<environment>_<key id>) of the management key that created it. Absent for a key NoResponse issued or a rotation made.
     *
     * @var ?string $createdBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_by')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $createdBy = null;

    /**
     * When a rotated key stops authenticating (POST /v1/keys/rotate). Absent for a key with no end.
     *
     * @var ?string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $expiresAt = null;

    /**
     *
     * @var ?string $revokedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('revoked_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $revokedAt = null;

    /**
     * The external user id of the member who revoked the key through the console, or the prefix of the management key that revoked it. Absent when the key is not revoked or NoResponse revoked it.
     *
     * @var ?string $revokedBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('revoked_by')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $revokedBy = null;

    /**
     * The credential, nrk_<environment>_<key id>_<secret>. Present only in the 201 answer that created the key.
     *
     * @var ?string $key
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('key')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $key = null;

    /**
     * @param  string  $id
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\KeyEnvironment|string  $environment
     * @param  string  $prefix
     * @param  array<\NoResponse\Models\Shared\KeyScope|string>  $scopes
     * @param  \NoResponse\Models\Shared\KeyStatus|string  $status
     * @param  string  $createdAt
     * @param  ?string  $createdBy
     * @param  ?string  $expiresAt
     * @param  ?string  $revokedAt
     * @param  ?string  $revokedBy
     * @param  ?string  $key
     * @phpstan-pure
     */
    public function __construct(string $id, string $workspaceId, KeyEnvironment|string $environment, string $prefix, array $scopes, KeyStatus|string $status, string $createdAt, ?string $createdBy = null, ?string $expiresAt = null, ?string $revokedAt = null, ?string $revokedBy = null, ?string $key = null)
    {
        $this->id = $id;
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
        $this->prefix = $prefix;
        $this->scopes = $scopes;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->createdBy = $createdBy;
        $this->expiresAt = $expiresAt;
        $this->revokedAt = $revokedAt;
        $this->revokedBy = $revokedBy;
        $this->key = $key;
    }
}