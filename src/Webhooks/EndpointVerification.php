<?php

declare(strict_types=1);

namespace NoResponse\Webhooks;

/** The challenge NoResponse sends when an endpoint is registered. */
final class EndpointVerification
{
    public function __construct(
        public readonly string $endpointId,
        public readonly string $challenge,
    ) {
    }
}
