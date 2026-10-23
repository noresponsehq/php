<?php

declare(strict_types=1);

namespace NoResponse\LateResults;

/**
 * Thrown when the provider's admin API refuses a call. Answer the webhook with
 * a 5xx so NoResponse retries it. The message holds no response body or credential.
 */
final class ProviderActionException extends \RuntimeException
{
    /**
     * @param  string|null  $errorCode  The provider's error code from the response body, such as Auth0's errorCode
     *                                  "insufficient_scope", when it sent one.
     */
    public function __construct(
        public readonly string $provider,
        public readonly int $status,
        string $message,
        public readonly ?string $errorCode = null,
    ) {
        parent::__construct($message);
    }
}
