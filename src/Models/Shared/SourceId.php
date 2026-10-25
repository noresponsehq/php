<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** A NoResponse source: github (GitHub accounts), phone (the phone lookup), breach (breach exposure), rdap (the email domain's registration), mx (the email domain's mail servers) or ipintel (IP intelligence). */
enum SourceId: string
{
    case Github = 'github';
    case Phone = 'phone';
    case Breach = 'breach';
    case Rdap = 'rdap';
    case Mx = 'mx';
    case Ipintel = 'ipintel';
}
