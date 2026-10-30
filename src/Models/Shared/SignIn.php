<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum SignIn: string
{
    case Password = 'password';
    case Google = 'google';
    case Facebook = 'facebook';
    case Apple = 'apple';
    case Microsoft = 'microsoft';
    case Sso = 'sso';
    case Other = 'other';
}
