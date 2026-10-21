<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Machine codes an HTTP 400 answer can carry. */
enum BadRequestErrorCode: string
{
    case InvalidRequest = 'invalid_request';
    case InvalidIdempotencyKey = 'invalid_idempotency_key';
    case InvalidCursor = 'invalid_cursor';
}
