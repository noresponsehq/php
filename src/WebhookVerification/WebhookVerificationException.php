<?php

declare(strict_types=1);

namespace NoResponse\WebhookVerification;

/**
 * Thrown by Webhook::constructEvent for a delivery that must not be processed: answer it with a 400 and do not process it.
 *
 * $errorCode is one of the class constants.
 */
final class WebhookVerificationException extends \RuntimeException
{
    public const MISSING_HEADER = 'missing_header';

    public const DUPLICATE_HEADER = 'duplicate_header';

    public const INVALID_TIMESTAMP = 'invalid_timestamp';

    public const UNKNOWN_KEY = 'unknown_key';

    public const INVALID_SIGNATURE = 'invalid_signature';

    public const INVALID_PAYLOAD = 'invalid_payload';

    public function __construct(public readonly string $errorCode, string $message)
    {
        parent::__construct('webhook verification failed: '.$message.' ('.$errorCode.')');
    }
}
