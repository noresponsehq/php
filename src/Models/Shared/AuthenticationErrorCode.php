<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Machine codes an HTTP 401 answer can carry. */
enum AuthenticationErrorCode: string
{
    case Unauthorized = 'unauthorized';
}
