<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** off: enrichment starts no search. suggest: enrichment starts no search by itself. automatic: after a workspace person's own investigation, and each time a search on that person finishes, enrichment starts searches by itself. */
enum EnrichmentMode: string
{
    case Off = 'off';
    case Suggest = 'suggest';
    case Automatic = 'automatic';
}
