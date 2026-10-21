<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The address's network type. */
enum IpSummaryType: string
{
    case Residential = 'residential';
    case Hosting = 'hosting';
    case Vpn = 'vpn';
    case Proxy = 'proxy';
    case Tor = 'tor';
    case Mobile = 'mobile';
    case Unknown = 'unknown';
}
