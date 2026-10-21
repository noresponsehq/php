<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AuthContext - Normalised claims from a session your backend has already verified with WorkOS, Clerk, Auth0 or any OIDC provider. Pass the output of the SDK's auth adapters, not a raw token. */
class AuthContext
{
    /**
     * Lowercase provider slug. WorkOS, Clerk and Auth0 have first-class adapters; every other provider uses a customer-specific OIDC slug. Provider brand is metadata; it does not change risk by itself.
     *
     * @var string $provider
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('provider')]
    public string $provider;

    /**
     * The verified token issuer, normally the provider's HTTPS issuer URL.
     *
     * @var string $issuer
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('issuer')]
    public string $issuer;

    /**
     * The verified stable subject identifier (`sub`), opaque to NoResponse.
     *
     * @var string $subject
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('subject')]
    public string $subject;

    /**
     * Whether the customer completed signature, issuer, audience and expiry validation before calling NoResponse. False contexts are accepted only as weak hints.
     *
     * @var bool $verified
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('verified')]
    public bool $verified;

    /**
     * The verified audience/resource identifier used by the customer's API. Use audiences when the provider emits multiple values.
     *
     * @var ?string $audience
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('audience')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $audience = null;

    /**
     * All verified audience/resource identifiers from an OAuth or OIDC token. The first value may also be copied to audience for simple integrations.
     *
     * @var ?array<string> $audiences
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('audiences')]
    #[\Speakeasy\Serializer\Annotation\Type('array<string>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $audiences = null;

    /**
     * The verified session identifier (`sid` or provider equivalent).
     *
     * @var ?string $sessionId
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('session_id')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $sessionId = null;

    /**
     * The active organization or workspace identifier, when the provider issued one.
     *
     * @var ?string $organizationId
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('organization_id')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $organizationId = null;

    /**
     * The provider tenant identifier, when distinct from organization_id.
     *
     * @var ?string $tenantId
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('tenant_id')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $tenantId = null;

    /**
     * The verified token identifier (`jti`), used for replay and rotation correlation.
     *
     * @var ?string $tokenId
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('token_id')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $tokenId = null;

    /**
     * Verified token issue time (`iat`).
     *
     * @var ?string $issuedAt
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('issued_at')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $issuedAt = null;

    /**
     * Verified token expiry (`exp`).
     *
     * @var ?string $expiresAt
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('expires_at')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $expiresAt = null;

    /**
     * Creation time of the provider session from the verified backend session record (for example Clerk Session.createdAt or WorkOS Session.created_at). This is separate from token issuance and auth_time.
     *
     * @var ?string $sessionCreatedAt
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('session_created_at')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $sessionCreatedAt = null;

    /**
     * Verified end-user authentication time (`auth_time`), when present.
     *
     * @var ?string $authTime
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('auth_time')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $authTime = null;

    /**
     * Account creation time from the customer's verified provider record, when available.
     *
     * @var ?string $accountCreatedAt
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('account_created_at')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $accountCreatedAt = null;

    /**
     * Whether the customer's provider asserts that the email identifier was verified.
     *
     * @var ?bool $emailVerified
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('email_verified')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?bool $emailVerified = null;

    /**
     * Whether the customer's provider asserts that the phone identifier was verified.
     *
     * @var ?bool $phoneVerified
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('phone_verified')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?bool $phoneVerified = null;

    /**
     * Provider or OIDC assurance level, when the customer has mapped one.
     *
     * @var ?\NoResponse\Models\Shared\AssuranceLevel $assuranceLevel
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('assurance_level')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssuranceLevel|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?AssuranceLevel $assuranceLevel = null;

    /**
     * Whether the verified session is acting on behalf of another subject.
     *
     * @var ?bool $impersonated
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('impersonated')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?bool $impersonated = null;

    /**
     * Where the customer derived this context. Backend is the trusted integration path; browser values are treated as weak hints.
     *
     * @var ?\NoResponse\Models\Shared\Transport $transport
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('transport')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\Transport|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?Transport $transport = null;

    /**
     * Normalized multi-factor evidence from a verified provider session.
     *
     * @var ?\NoResponse\Models\Shared\AuthContextMfa $mfa
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('mfa')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\AuthContextMfa|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?AuthContextMfa $mfa = null;

    /**
     * Bounded role slugs from the verified provider; roles do not change risk by themselves.
     *
     * @var ?array<string> $roles
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('roles')]
    #[\Speakeasy\Serializer\Annotation\Type('array<string>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $roles = null;

    /**
     * Bounded scopes from the verified access token; scopes do not change risk by themselves.
     *
     * @var ?array<string> $scopes
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('scopes')]
    #[\Speakeasy\Serializer\Annotation\Type('array<string>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $scopes = null;

    /**
     * @param  string  $provider
     * @param  string  $issuer
     * @param  string  $subject
     * @param  bool  $verified
     * @param  ?string  $audience
     * @param  ?array<string>  $audiences
     * @param  ?string  $sessionId
     * @param  ?string  $organizationId
     * @param  ?string  $tenantId
     * @param  ?string  $tokenId
     * @param  ?string  $issuedAt
     * @param  ?string  $expiresAt
     * @param  ?string  $sessionCreatedAt
     * @param  ?string  $authTime
     * @param  ?string  $accountCreatedAt
     * @param  ?bool  $emailVerified
     * @param  ?bool  $phoneVerified
     * @param  ?\NoResponse\Models\Shared\AssuranceLevel  $assuranceLevel
     * @param  ?bool  $impersonated
     * @param  ?\NoResponse\Models\Shared\Transport  $transport
     * @param  ?\NoResponse\Models\Shared\AuthContextMfa  $mfa
     * @param  ?array<string>  $roles
     * @param  ?array<string>  $scopes
     * @phpstan-pure
     */
    public function __construct(string $provider, string $issuer, string $subject, bool $verified, ?string $audience = null, ?array $audiences = null, ?string $sessionId = null, ?string $organizationId = null, ?string $tenantId = null, ?string $tokenId = null, ?string $issuedAt = null, ?string $expiresAt = null, ?string $sessionCreatedAt = null, ?string $authTime = null, ?string $accountCreatedAt = null, ?bool $emailVerified = null, ?bool $phoneVerified = null, ?AssuranceLevel $assuranceLevel = null, ?bool $impersonated = null, ?Transport $transport = null, ?AuthContextMfa $mfa = null, ?array $roles = null, ?array $scopes = null)
    {
        $this->provider = $provider;
        $this->issuer = $issuer;
        $this->subject = $subject;
        $this->verified = $verified;
        $this->audience = $audience;
        $this->audiences = $audiences;
        $this->sessionId = $sessionId;
        $this->organizationId = $organizationId;
        $this->tenantId = $tenantId;
        $this->tokenId = $tokenId;
        $this->issuedAt = $issuedAt;
        $this->expiresAt = $expiresAt;
        $this->sessionCreatedAt = $sessionCreatedAt;
        $this->authTime = $authTime;
        $this->accountCreatedAt = $accountCreatedAt;
        $this->emailVerified = $emailVerified;
        $this->phoneVerified = $phoneVerified;
        $this->assuranceLevel = $assuranceLevel;
        $this->impersonated = $impersonated;
        $this->transport = $transport;
        $this->mfa = $mfa;
        $this->roles = $roles;
        $this->scopes = $scopes;
    }
}