<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Integration - A hosted provider integration. Point the provider at url: a WorkOS user registration or authentication Action, or the NoResponse Auth0 Action, which sends secret as a bearer token. The answer allows or denies the event: deny only when the assessment's risk.block is true, and allow on every failure, so a fault on the NoResponse side lets the user through. secret is present only in the answers of POST /v1/integrations and POST /v1/integrations/{integration_id}/rotate for an Auth0 integration, and is not returned again. */
class Integration
{
    /**
     * Opaque, server-assigned integration id: int_ and a 26-character Crockford base32 ULID. Another workspace's integration id answers 404.
     *
     * @var string $integrationId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('integration_id')]
    public string $integrationId;

    /**
     * The authentication provider that calls the endpoint.
     *
     * @var \NoResponse\Models\Shared\IntegrationPlatform|string $platform
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('platform')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IntegrationPlatform|string')]
    public IntegrationPlatform|string $platform;

    /**
     * Each hook point at most once.
     *
     * @var array<\NoResponse\Models\Shared\IntegrationHookPoint|string> $hookPoints
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('hook_points')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\IntegrationHookPoint|string>')]
    public array $hookPoints;

    /**
     * The hosted endpoint, https://api.noresponse.org/hooks/{integration_id} in production.
     *
     * @var string $url
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('url')]
    public string $url;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * Auth0 only, and only when it is created or rotated: the shared secret the Auth0 Action sends as Authorization: Bearer <secret>. nri_ and 43 unpadded base64url characters (32 random bytes). Store it as an Auth0 Action secret.
     *
     * @var ?string $secret
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('secret')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $secret = null;

    /**
     * When the secret was last rotated; absent until the first rotation.
     *
     * @var ?string $rotatedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('rotated_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $rotatedAt = null;

    /**
     * After a rotation, when the replaced secret stops being accepted; absent when no replaced secret is still accepted.
     *
     * @var ?string $previousSecretExpiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('previous_secret_expires_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $previousSecretExpiresAt = null;

    /**
     * @param  string  $integrationId
     * @param  \NoResponse\Models\Shared\IntegrationPlatform|string  $platform
     * @param  array<\NoResponse\Models\Shared\IntegrationHookPoint|string>  $hookPoints
     * @param  string  $url
     * @param  string  $createdAt
     * @param  ?string  $secret
     * @param  ?string  $rotatedAt
     * @param  ?string  $previousSecretExpiresAt
     * @phpstan-pure
     */
    public function __construct(string $integrationId, IntegrationPlatform|string $platform, array $hookPoints, string $url, string $createdAt, ?string $secret = null, ?string $rotatedAt = null, ?string $previousSecretExpiresAt = null)
    {
        $this->integrationId = $integrationId;
        $this->platform = $platform;
        $this->hookPoints = $hookPoints;
        $this->url = $url;
        $this->createdAt = $createdAt;
        $this->secret = $secret;
        $this->rotatedAt = $rotatedAt;
        $this->previousSecretExpiresAt = $previousSecretExpiresAt;
    }
}