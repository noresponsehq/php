<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** active: the key authenticates. expired: a rotation's overlap window has ended (expires_at). revoked: the key was revoked (revoked_at) and answers 401. */
enum KeyStatus: string
{
    case Active = 'active';
    case Expired = 'expired';
    case Revoked = 'revoked';
}
