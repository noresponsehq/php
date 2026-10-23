<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentDetailAuthContext - The identity fields of the auth context the assessment was made with, echoed for the workspace's own correlation: the request's auth_context, or the one a hosted provider hook (POST /hooks/{integration_id}) built, with transport provider_hook and its hook_point. Present exactly when the request carried an auth_context, and the same on every revision of the assessment. Values are as the request or the hook sent them; tokens, timestamps, roles and scopes are not echoed, and the echo does not change the score. */
class AssessmentDetailAuthContext
{
    /**
     * The provider slug the context named.
     *
     * @var string $provider
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('provider')]
    public string $provider;

    /**
     * The issuer the context named.
     *
     * @var string $issuer
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('issuer')]
    public string $issuer;

    /**
     * The verified flag the context carried. A provider_hook context is always false.
     *
     * @var bool $verified
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('verified')]
    public bool $verified;

    /**
     * Where the context was derived: backend (also when the request named no transport), browser, or provider_hook for a hosted provider hook.
     *
     * @var \NoResponse\Models\Shared\Transport $transport
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('transport')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Transport')]
    public Transport $transport;

    /**
     * The subject the context named; absent when it named none (a pre_registration hook).
     *
     * @var ?string $subject
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('subject')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $subject = null;

    /**
     * The session identifier the context named, when it named one.
     *
     * @var ?string $sessionId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('session_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $sessionId = null;

    /**
     * The organization identifier the context named, when it named one.
     *
     * @var ?string $organizationId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('organization_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $organizationId = null;

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
     * @param  string  $provider
     * @param  string  $issuer
     * @param  bool  $verified
     * @param  \NoResponse\Models\Shared\Transport  $transport
     * @param  ?string  $subject
     * @param  ?string  $sessionId
     * @param  ?string  $organizationId
     * @param  ?\NoResponse\Models\Shared\HookPoint  $hookPoint
     * @phpstan-pure
     */
    public function __construct(string $provider, string $issuer, bool $verified, Transport $transport, ?string $subject = null, ?string $sessionId = null, ?string $organizationId = null, ?HookPoint $hookPoint = null)
    {
        $this->provider = $provider;
        $this->issuer = $issuer;
        $this->verified = $verified;
        $this->transport = $transport;
        $this->subject = $subject;
        $this->sessionId = $sessionId;
        $this->organizationId = $organizationId;
        $this->hookPoint = $hookPoint;
    }
}