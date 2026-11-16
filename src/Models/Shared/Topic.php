<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum Topic: string
{
    case Identity = 'identity';
    case Location = 'location';
    case Movement = 'movement';
    case Timeline = 'timeline';
    case Interests = 'interests';
    case Relationships = 'relationships';
    case Work = 'work';
    case Education = 'education';
    case Accounts = 'accounts';
    case Credentials = 'credentials';
    case Devices = 'devices';
    case Absence = 'absence';
}
