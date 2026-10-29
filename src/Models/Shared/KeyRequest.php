<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** KeyRequest - Creates a key whose scopes are bounded by the issuer capabilities in this environment. Delete is owner-only. A service key outlives its creator; a personal key belongs to the authenticated member and is revoked on membership or authority changes. request_id deduplicates creation: retry returns 200 metadata without the secret; changed parameters answer 409. Team scopes members and members_manage are explicitly workspace-wide, live-only, and delegated by a current full owner. Personal credentials cannot hold management or members_manage. Legacy management includes policy publication; use settings without policy_publish for configuration preparation and retention-only edits. */
class KeyRequest
{
    /**
     * The environment the key belongs to. A live key assesses with live sources; a test key answers from the deterministic simulator.
     *
     * @var \NoResponse\Models\Shared\KeyEnvironment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\KeyEnvironment|string')]
    public KeyEnvironment|string $environment;

    /**
     * The key's scopes, each at most once.
     *
     * @var array<\NoResponse\Models\Shared\KeyRequestScope> $scopes
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('scopes')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\KeyRequestScope>')]
    public array $scopes;

    /**
     * Optional display name for this API key, at most 100 printable characters. Preserved on rotation.
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
     * Between one minute and 365 days from now.
     *
     * @var ?string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $expiresAt = null;

    /**
     * Caller-chosen identifier for one creation attempt, scoped to the issuing actor and environment. Use 1 to 256 printable ASCII characters without spaces. A retry with the same parameters returns the original key metadata with status 200 and no secret; changed parameters return 409.
     *
     * @var ?string $requestId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('request_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $requestId = null;

    /**
     * @param  \NoResponse\Models\Shared\KeyEnvironment|string  $environment
     * @param  array<\NoResponse\Models\Shared\KeyRequestScope>  $scopes
     * @param  ?string  $name
     * @param  ?string  $purpose
     * @param  \NoResponse\Models\Shared\KeyKind|string|null  $kind
     * @param  ?string  $expiresAt
     * @param  ?string  $requestId
     * @phpstan-pure
     */
    public function __construct(KeyEnvironment|string $environment, array $scopes, ?string $name = null, ?string $purpose = null, KeyKind|string|null $kind = null, ?string $expiresAt = null, ?string $requestId = null)
    {
        $this->environment = $environment;
        $this->scopes = $scopes;
        $this->name = $name;
        $this->purpose = $purpose;
        $this->kind = $kind;
        $this->expiresAt = $expiresAt;
        $this->requestId = $requestId;
    }
}