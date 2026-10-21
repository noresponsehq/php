<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The submitted identifier or client context field a reason concerns; absent when it concerns the whole assessment. Client context is a claimed hint, not a device fingerprint. */
enum ReasonIdentifier: string
{
    case Email = 'email';
    case Username = 'username';
    case Phone = 'phone';
    case Name = 'name';
    case Ip = 'ip';
    case Context = 'context';
}
