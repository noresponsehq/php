<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WebhookVerificationResponse - The body an endpoint returns, with status 200 and Content-Type application/json within 5 seconds, to an endpoint.verification event. A 2xx without the echoed challenge does not verify the endpoint. */
class WebhookVerificationResponse
{
    /**
     * Endpoint verification nonce: 32 random bytes, unpadded base64url (43 characters). Fresh per verification.
     *
     * @var string $challenge
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('challenge')]
    public string $challenge;

    /**
     * @param  string  $challenge
     * @phpstan-pure
     */
    public function __construct(string $challenge)
    {
        $this->challenge = $challenge;
    }
}