<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** pre_registration runs before the user exists; post_login runs after a successful sign-in. */
enum IntegrationHookPoint: string
{
    case PreRegistration = 'pre_registration';
    case PostLogin = 'post_login';
}
