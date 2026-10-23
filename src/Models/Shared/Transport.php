<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Where the context was derived: backend (also when the request named no transport), browser, or provider_hook for a hosted provider hook. */
enum Transport: string
{
    case Backend = 'backend';
    case Browser = 'browser';
    case ProviderHook = 'provider_hook';
}
