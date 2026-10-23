<?php

declare(strict_types=1);

namespace NoResponse\Webhooks;

/**
 * Another endpoint of this environment was disabled after failing
 * continuously for 72 hours. It receives nothing more until it is verified
 * again. failingSince is when its deliveries started failing.
 */
final class EndpointDisabled
{
    public function __construct(
        public readonly string $endpointId,
        public readonly string $failingSince,
        public readonly string $disabledAt,
    ) {
    }
}
