<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The provider flow the assessment gates. Absent means signup. */
enum Flow: string
{
    case Signup = 'signup';
    case Login = 'login';
    case Recovery = 'recovery';
    case ProfileChange = 'profile_change';
}
