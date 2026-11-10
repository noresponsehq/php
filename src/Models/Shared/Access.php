<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** public profiles were read; a private or locked one exists but could not be read. */
enum Access: string
{
    case Public = 'public';
    case Private = 'private';
    case Locked = 'locked';
}
