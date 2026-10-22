<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Where this context was derived. Backend is the trusted integration path; browser values are treated as weak hints. provider_hook is a hosted provider hook (an Auth0 or WorkOS Action) calling at hook_point; it needs hook_point and verified false, and its authentication facts are not scored. */
enum Transport: string
{
    case Backend = 'backend';
    case Browser = 'browser';
    case ProviderHook = 'provider_hook';
}
