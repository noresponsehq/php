<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Who is in the table: site_breach, a site's own users; credential_list, a combolist or compilation; stealer_log, malware or botnet victims; scrape; hacking_forum, a criminal hacking, cracking or carding community; abuse_service, the customers of DDoS-for-hire, account generators, dump or card shops, darknet markets, stalkerware or breach-lookup services; darkweb_site, an onion site of unknown purpose. */
enum BreachKind: string
{
    case SiteBreach = 'site_breach';
    case CredentialList = 'credential_list';
    case StealerLog = 'stealer_log';
    case Scrape = 'scrape';
    case HackingForum = 'hacking_forum';
    case AbuseService = 'abuse_service';
    case DarkwebSite = 'darkweb_site';
}
