<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** decision, recommendation and band: the first answer's. flow: the assessment's. list_match: the action of the list entry that decided the account when it was first answered. reason: a reason the first answer fired, with its impact band. lane: an evidence lane the first answer listed in incomplete_sources. country and asn: the submitted IP's, from the IP data. */
enum AggregateDimension: string
{
    case Decision = 'decision';
    case Flow = 'flow';
    case Recommendation = 'recommendation';
    case Band = 'band';
    case Reason = 'reason';
    case Lane = 'lane';
    case Country = 'country';
    case Asn = 'asn';
    case ListMatch = 'list_match';
}
