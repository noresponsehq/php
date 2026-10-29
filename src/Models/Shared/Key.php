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
     * The earlier of the explicit lifetime and any rotation overlap. Rotation preserves the original lifetime.
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
     * The optional display name supplied for this API key. Preserved on rotation.
     *
     * @var ?string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $name = null;

    /**
     * Optional operational purpose, at most 200 printable characters without leading or trailing whitespace. Do not put secrets or personal data here. Preserved on rotation and included in the creation request fingerprint; omitted for older credentials.
     *
     * @var ?string $purpose
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('purpose')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $purpose = null;

    /**
     *
     * @var \NoResponse\Models\Shared\KeyKind|string|null $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\KeyKind|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public KeyKind|string|null $kind = null;

    /**
     * The issuing member's external identity for a personal key. Personal ownership is fixed and the key is revoked when that member loses authority. Service keys belong to the workspace and omit this field.
     *
     * @var ?string $ownerUserId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('owner_user_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $ownerUserId = null;

    /**
     * Replacement public key identifier, or legacy when the successor predates recorded lineage. This field excludes the secret.
     *
     * @var ?string $rotatedTo
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('rotated_to')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $rotatedTo = null;

    /**
     * Latest recorded authenticated request observation, updated at most once per minute. Capture is best effort after the response and includes authenticated requests refused by authorization or rate limits. Absence means unknown and does not prove the key was unused. It is independent of diagnostic retention and resets on the replacement key after rotation. This field retains no raw IP or user-agent.
     *
     * @var ?string $lastUsedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('last_used_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $lastUsedAt = null;

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
     * @param  ?string  $name
     * @param  ?string  $purpose
     * @param  \NoResponse\Models\Shared\KeyKind|string|null  $kind
     * @param  ?string  $ownerUserId
     * @param  ?string  $rotatedTo
     * @param  ?string  $lastUsedAt
     * @phpstan-pure
     */
    public function __construct(string $id, string $workspaceId, KeyEnvironment|string $environment, string $prefix, array $scopes, KeyStatus|string $status, string $createdAt, ?string $createdBy = null, ?string $expiresAt = null, ?string $revokedAt = null, ?string $revokedBy = null, ?string $key = null, ?string $name = null, ?string $purpose = null, KeyKind|string|null $kind = null, ?string $ownerUserId = null, ?string $rotatedTo = null, ?string $lastUsedAt = null)
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
        $this->name = $name;
        $this->purpose = $purpose;
        $this->kind = $kind;
        $this->ownerUserId = $ownerUserId;
        $this->rotatedTo = $rotatedTo;
        $this->lastUsedAt = $lastUsedAt;
    }
}