<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class EndpointVerification
{
    /**
     * Opaque id of the endpoint registration being verified.
     *
     * @var string $endpointId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('endpoint_id')]
    public string $endpointId;

    /**
     * Endpoint verification nonce: 32 random bytes, unpadded base64url (43 characters). Fresh per verification.
     *
     * @var string $challenge
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('challenge')]
    public string $challenge;

    /**
     * @param  string  $endpointId
     * @param  string  $challenge
     * @phpstan-pure
     */
    public function __construct(string $endpointId, string $challenge)
    {
        $this->endpointId = $endpointId;
        $this->challenge = $challenge;
    }
}