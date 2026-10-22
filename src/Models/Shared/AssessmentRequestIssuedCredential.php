<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentRequestIssuedCredential - Optional. When the signup gate issues an API key to the new account, send SHA-256 of that key, so later usage of the key, or a leaked copy, ties back to this assessment. Each SDK has a helper that computes it. Send only the hash: customer keys are high-entropy, so the hash reveals nothing about them. The assessment stores it, and no response, webhook or log carries it. */
class AssessmentRequestIssuedCredential
{
    /**
     * SHA-256 of the issued key's UTF-8 bytes, as 64 lower-case hex characters.
     *
     * @var string $sha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('sha256')]
    public string $sha256;

    /**
     * @param  string  $sha256
     * @phpstan-pure
     */
    public function __construct(string $sha256)
    {
        $this->sha256 = $sha256;
    }
}