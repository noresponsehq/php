<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WebhookEndpointRequest - POST /v1/webhooks body. The workspace is the API key that signs the request, so it is not a body member. The URL must be https on port 443 or 8443 with a DNS name, not an IP literal, and every address the name resolves to must be public. */
class WebhookEndpointRequest
{
    /**
     * Where deliveries are sent: an https URL on port 443 or 8443, with a DNS host and no userinfo or fragment, at most 2048 characters.
     *
     * @var string $url
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('url')]
    public string $url;

    /**
     * standard returns the consolidated risk response; detailed adds merged provider-neutral facts when the key has detailed scope. There is no raw mode.
     *
     * @var ?\NoResponse\Models\Shared\ResponseMode $responseMode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('response_mode')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ResponseMode|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?ResponseMode $responseMode = null;

    /**
     * @param  string  $url
     * @param  ?\NoResponse\Models\Shared\ResponseMode  $responseMode
     * @phpstan-pure
     */
    public function __construct(string $url, ?ResponseMode $responseMode = null)
    {
        $this->url = $url;
        $this->responseMode = $responseMode;
    }
}