<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** IntegrationRequest - POST /v1/integrations body. Registers a hosted endpoint for one authentication provider. The workspace is the API key that signs the request, so the body has no workspace field and refuses one like any other unknown member. A WorkOS integration needs signing_secret, the Actions secret shown in the WorkOS dashboard, which NoResponse uses to verify each Action request and to sign its answer. A Supabase integration needs signing_secret, the hook secret Supabase generates for a Before User Created HTTPS hook (v1,whsec_ and base64), which NoResponse uses to verify each call. An Auth0 integration sends no signing_secret: NoResponse generates the shared secret and returns it once. */
class IntegrationRequest
{
    /**
     * The authentication provider that calls the endpoint.
     *
     * @var \NoResponse\Models\Shared\IntegrationPlatform|string $platform
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('platform')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IntegrationPlatform|string')]
    public IntegrationPlatform|string $platform;

    /**
     * The provider events the endpoint scores. Default every hook point the platform has: pre_registration (WorkOS user registration Action, Auth0 pre-user-registration trigger, Supabase Before User Created hook) and post_login (WorkOS authentication Action, Auth0 post-login trigger). Supabase has only pre_registration, so a Supabase integration that lists post_login is refused. An event that is not listed is answered allow without an assessment.
     *
     * @var array<\NoResponse\Models\Shared\IntegrationHookPoint|string>|null $hookPoints
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('hook_points')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\IntegrationHookPoint|string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $hookPoints = null;

    /**
     * The WorkOS Actions signing secret or the Supabase hook secret, as the provider's dashboard shows it: 16 to 256 printable ASCII characters with no spaces. It is stored sealed and is not returned.
     *
     * @var ?string $signingSecret
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('signing_secret')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $signingSecret = null;

    /**
     * @param  \NoResponse\Models\Shared\IntegrationPlatform|string  $platform
     * @param  array<\NoResponse\Models\Shared\IntegrationHookPoint|string>|null  $hookPoints
     * @param  ?string  $signingSecret
     * @phpstan-pure
     */
    public function __construct(IntegrationPlatform|string $platform, ?array $hookPoints = null, ?string $signingSecret = null)
    {
        $this->platform = $platform;
        $this->hookPoints = $hookPoints;
        $this->signingSecret = $signingSecret;
    }
}