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
    #[\NoResponse\Serializer\Annotation\SerializedName('provider')]
    public string $provider;

    /**
     * The verified token issuer, normally the provider's HTTPS issuer URL.
     *
     * @var string $issuer
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('issuer')]
    public string $issuer;

    /**
     * The verified stable subject identifier (`sub`), opaque to NoResponse. Required, except from a provider hook at pre_registration, where no user exists yet.
     *
     * @var string $subject
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('subject')]
    public string $subject;

    /**
     * Whether the customer completed signature, issuer, audience and expiry validation before calling NoResponse. False contexts are accepted only as weak hints.
     *
     * @var bool $verified
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('verified')]
    public bool $verified;

    /**
     * The verified audience/resource identifier used by the customer's API. Use audiences when the provider emits multiple values.
     *
     * @var ?string $audience
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('audience')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $audience = null;

    /**
     * All verified audience/resource identifiers from an OAuth or OIDC token. The first value may also be copied to audience for simple integrations.
     *
     * @var ?array<string> $audiences
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('audiences')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $audiences = null;

    /**
     * The verified session identifier (`sid` or provider equivalent).
     *
     * @var ?string $sessionId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('session_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $sessionId = null;

    /**
     * The active organization or workspace identifier, when the provider issued one.
     *
     * @var ?string $organizationId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('organization_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $organizationId = null;

    /**
     * The provider tenant identifier, when distinct from organization_id.
     *
     * @var ?string $tenantId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('tenant_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $tenantId = null;

    /**
     * The verified token identifier (`jti`), used for replay and rotation correlation.
     *
     * @var ?string $tokenId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('token_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $tokenId = null;

    /**
     * Verified token issue time (`iat`).
     *
     * @var ?string $issuedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('issued_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $issuedAt = null;

    /**
     * Verified token expiry (`exp`).
     *
     * @var ?string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $expiresAt = null;

    /**
     * Creation time of the provider session from the verified backend session record (for example Clerk Session.createdAt or WorkOS Session.created_at). This is separate from token issuance and auth_time.
     *
     * @var ?string $sessionCreatedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('session_created_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $sessionCreatedAt = null;

    /**
     * Verified end-user authentication time (`auth_time`), when present.
     *
     * @var ?string $authTime
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('auth_time')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $authTime = null;

    /**
     * Account creation time from the customer's verified provider record, when available.
     *
     * @var ?string $accountCreatedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_created_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $accountCreatedAt = null;

    /**
     * Whether the customer's provider asserts that the email identifier was verified.
     *
     * @var ?bool $emailVerified
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('email_verified')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $emailVerified = null;

    /**
     * Whether the customer's provider asserts that the phone identifier was verified.
     *
     * @var ?bool $phoneVerified
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('phone_verified')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $phoneVerified = null;

    /**
     * Provider or OIDC assurance level, when the customer has mapped one.
     *
     * @var ?\NoResponse\Models\Shared\AssuranceLevel $assuranceLevel
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assurance_level')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssuranceLevel|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AssuranceLevel $assuranceLevel = null;

    /**
     * Whether the verified session is acting on behalf of another subject.
     *
     * @var ?bool $impersonated
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('impersonated')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $impersonated = null;

    /**
     * Where the context was derived: backend (also when the request named no transport), browser, or provider_hook for a hosted provider hook.
     *
     * @var ?\NoResponse\Models\Shared\Transport $transport
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('transport')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Transport|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?Transport $transport = null;

    /**
     * The provider event a provider_hook context was sent for; absent for any other transport.
     *
     * @var ?\NoResponse\Models\Shared\HookPoint $hookPoint
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('hook_point')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\HookPoint|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?HookPoint $hookPoint = null;

    /**
     * Normalized multi-factor evidence from a verified provider session.
     *
     * @var ?\NoResponse\Models\Shared\AuthContextMfa $mfa
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('mfa')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AuthContextMfa|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AuthContextMfa $mfa = null;

    /**
     * Bounded role slugs from the verified provider; roles do not change risk by themselves.
     *
     * @var ?array<string> $roles
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('roles')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $roles = null;

    /**
     * Bounded scopes from the verified access token; scopes do not change risk by themselves.
     *
     * @var ?array<string> $scopes
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('scopes')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
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
     * @param  ?\NoResponse\Models\Shared\HookPoint  $hookPoint
     * @param  ?\NoResponse\Models\Shared\AuthContextMfa  $mfa
     * @param  ?array<string>  $roles
     * @param  ?array<string>  $scopes
     * @phpstan-pure
     */
    public function __construct(string $provider, string $issuer, string $subject, bool $verified, ?string $audience = null, ?array $audiences = null, ?string $sessionId = null, ?string $organizationId = null, ?string $tenantId = null, ?string $tokenId = null, ?string $issuedAt = null, ?string $expiresAt = null, ?string $sessionCreatedAt = null, ?string $authTime = null, ?string $accountCreatedAt = null, ?bool $emailVerified = null, ?bool $phoneVerified = null, ?AssuranceLevel $assuranceLevel = null, ?bool $impersonated = null, ?Transport $transport = null, ?HookPoint $hookPoint = null, ?AuthContextMfa $mfa = null, ?array $roles = null, ?array $scopes = null)
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
        $this->hookPoint = $hookPoint;
        $this->mfa = $mfa;
        $this->roles = $roles;
        $this->scopes = $scopes;
    }
}