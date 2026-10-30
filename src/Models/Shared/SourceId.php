<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** A NoResponse source: github (GitHub accounts), phone (the phone lookup), breach (breach exposure), rdap (the email domain's registration), mx (the email domain's mail servers), ipintel (IP intelligence) or an email account source that searches one platform for an account by email address (adobe, nvidia, wix, life360, zapier). */
enum SourceId: string
{
    case Github = 'github';
    case Phone = 'phone';
    case Breach = 'breach';
    case Rdap = 'rdap';
    case Mx = 'mx';
    case Ipintel = 'ipintel';
    case Adobe = 'adobe';
    case Nvidia = 'nvidia';
    case Wix = 'wix';
    case Life360 = 'life360';
    case Zapier = 'zapier';
}
