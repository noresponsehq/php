<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Why the attempt failed: the URL is no longer valid, the host did not resolve, it resolved to an address that is not public, no answer within 5 seconds, the connection failed, a 3xx (redirects are not followed) or another non-2xx status. Absent for a delivered attempt. */
enum Failure: string
{
    case InvalidUrl = 'invalid_url';
    case ResolveFailed = 'resolve_failed';
    case AddressRefused = 'address_refused';
    case Timeout = 'timeout';
    case ConnectionFailed = 'connection_failed';
    case Redirect = 'redirect';
    case Non2xx = 'non_2xx';
}
