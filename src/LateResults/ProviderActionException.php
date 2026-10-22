<?php

declare(strict_types=1);

namespace NoResponse\LateResults;

/**
 * Thrown when the provider's admin API refuses a call. Answer the webhook with
 * a 5xx so NoResponse retries it. The message holds no response body or credential.
 */
final class ProviderActionException extends \RuntimeException
{
    public function __construct(public readonly string $provider, public readonly int $status, string $message)
    {
        parent::__construct($message);
    }
}
