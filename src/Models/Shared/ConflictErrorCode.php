<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Machine codes an HTTP 409 answer can carry. */
enum ConflictErrorCode: string
{
    case IdempotencyKeyReused = 'idempotency_key_reused';
    case KeyRotationInProgress = 'key_rotation_in_progress';
    case TooManyIntegrations = 'too_many_integrations';
}
