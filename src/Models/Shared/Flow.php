<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The provider flow the assessment gates. Use the top-level flow instead; this member is ignored when the top-level flow is present. Absent means signup. */
enum Flow: string
{
    case Signup = 'signup';
    case Login = 'login';
    case Recovery = 'recovery';
    case ProfileChange = 'profile_change';
}
