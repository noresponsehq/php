<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ScreeningPlatform: string
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
}
