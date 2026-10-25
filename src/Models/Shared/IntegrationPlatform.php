<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The authentication provider that calls the endpoint. */
enum IntegrationPlatform: string
{
    case Workos = 'workos';
    case Auth0 = 'auth0';
    case Supabase = 'supabase';
}
