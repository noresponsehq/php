<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** CredentialRequest - Associate the SHA-256 of a high-entropy key issued by your service. Send the hash instead of the key. Repeating a hash returns its original association, including its retirement state. A hash associated with another account returns a conflict. */
class CredentialRequest
{
    /**
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