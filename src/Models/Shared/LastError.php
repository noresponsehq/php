<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum LastError: string
{
    case ScreeningCapExceeded = 'screening_cap_exceeded';
    case ScreeningUnavailable = 'screening_unavailable';
    case PersonNotFound = 'person_not_found';
    case IdempotencyKeyReused = 'idempotency_key_reused';
}
