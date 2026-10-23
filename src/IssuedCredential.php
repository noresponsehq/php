<?php

declare(strict_types=1);

namespace NoResponse;

use InvalidArgumentException;

/** Hash an API key your platform issued. Hand-written beside the generated client. */
final class IssuedCredential
{
    /**
     * SHA-256 of an issued API key, as 64 lower-case hex characters. The key never leaves your
     * backend: send only this hash, as issued_credential.sha256 on the assessment request. The key
     * is hashed as its UTF-8 bytes exactly as given, with no trimming or normalisation.
     *
     * @throws InvalidArgumentException if the key is empty
     */
    public static function sha256(string $key): string
    {
        if ($key === '') {
            throw new InvalidArgumentException('Issued key must not be empty.');
        }

        return hash('sha256', $key);
    }
}
