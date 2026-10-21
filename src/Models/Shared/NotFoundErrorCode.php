<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Machine codes an HTTP 404 answer can carry. */
enum NotFoundErrorCode: string
{
    case NotFound = 'not_found';
}
