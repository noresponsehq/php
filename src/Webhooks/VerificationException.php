<?php

declare(strict_types=1);

namespace NoResponse\Webhooks;

/**
 * Thrown by Webhook::constructEvent. Answer 400 and do not process the delivery.
 *
 * code is one of missing_header, duplicate_header, invalid_timestamp,
 * unknown_key, invalid_signature or invalid_payload.
 */
final class VerificationException extends \RuntimeException
{
    public function __construct(public readonly string $errorCode, string $message)
    {
        parent::__construct($message);
    }
}
