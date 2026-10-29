<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ErasureReceiptTargetName: string
{
    case Serving = 'serving';
    case Outbox = 'outbox';
    case Cache = 'cache';
    case DownstreamProjection = 'downstream_projection';
}
