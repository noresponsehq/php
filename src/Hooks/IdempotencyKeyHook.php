<?php

declare(strict_types=1);

namespace NoResponse\Hooks;

use Psr\Http\Message\RequestInterface;

/**
 * Sends a fresh UUID as the Idempotency-Key when the caller gave none. The hook
 * runs once per call, before any retry, so every attempt carries the same key.
 */
final class IdempotencyKeyHook implements BeforeRequestHook
{
    private const OPERATIONS = ['createAssessment', 'recordAssessmentOutcome', 'recordKeyUsage', 'recordAccountOutcome', 'changeLists', 'createPolicyEvaluation'];

    public function beforeRequest(BeforeRequestContext $context, RequestInterface $request): RequestInterface
    {
        if (! in_array($context->operationID, self::OPERATIONS, true) || $request->hasHeader('Idempotency-Key')) {
            return $request;
        }

        return $request->withHeader('Idempotency-Key', self::uuid());
    }

    private static function uuid(): string
    {
        $bytes = random_bytes(16);
        $bytes[6] = chr((ord($bytes[6]) & 0x0F) | 0x40);
        $bytes[8] = chr((ord($bytes[8]) & 0x3F) | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));
    }
}
