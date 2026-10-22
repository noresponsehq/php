<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** IntegrationRotationRequest - POST /v1/integrations/{integration_id}/rotate body. For an Auth0 integration send {}: NoResponse generates a new shared secret and returns it once. For a WorkOS integration send the new signing_secret after regenerating it in the WorkOS dashboard. Either way the previous secret is still accepted for 24 hours, so the provider can be switched over without a refused call. */
class IntegrationRotationRequest
{
    /**
     * The WorkOS Actions signing secret, as the WorkOS dashboard shows it: 16 to 256 printable ASCII characters with no spaces. It is stored sealed and is not returned.
     *
     * @var ?string $signingSecret
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('signing_secret')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $signingSecret = null;

    /**
     * @param  ?string  $signingSecret
     * @phpstan-pure
     */
    public function __construct(?string $signingSecret = null)
    {
        $this->signingSecret = $signingSecret;
    }
}