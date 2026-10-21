<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The kind of data a breach table held beside the identifier. password means a plaintext password was present and password_hash means a hash, salt or token was present. The value itself is not stored or returned; the schema has no member for one. */
enum BreachExposed: string
{
    case Email = 'email';
    case Username = 'username';
    case Name = 'name';
    case Password = 'password';
    case PasswordHash = 'password_hash';
    case Phone = 'phone';
    case Address = 'address';
    case Dob = 'dob';
    case Ip = 'ip';
    case Payment = 'payment';
    case SecurityQa = 'security_qa';
}
