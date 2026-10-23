<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The provider event a provider_hook context was sent for; absent for any other transport. */
enum HookPoint: string
{
    case PreRegistration = 'pre_registration';
    case PostRegistration = 'post_registration';
    case PreLogin = 'pre_login';
    case PostLogin = 'post_login';
    case TokenIssuance = 'token_issuance';
}
