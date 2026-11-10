<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** A platform a screening can cover. synthetic is the deterministic connector's own platform, for exercising the product end to end with no network. */
enum HandlePlatform: string
{
    case Instagram = 'instagram';
    case X = 'x';
    case Bluesky = 'bluesky';
    case Youtube = 'youtube';
    case Tiktok = 'tiktok';
    case Facebook = 'facebook';
    case Threads = 'threads';
    case Reddit = 'reddit';
    case Telegram = 'telegram';
    case Linkedin = 'linkedin';
    case Synthetic = 'synthetic';
}
