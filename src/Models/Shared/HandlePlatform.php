<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** A platform a screening can cover. github and scratch through flickr are each one read of the public profile a handle names, with no posts. synthetic is the deterministic connector's own platform, for exercising the product end to end with no network. */
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
    case Github = 'github';
    case Scratch = 'scratch';
    case Dailymotion = 'dailymotion';
    case Substack = 'substack';
    case Duolingo = 'duolingo';
    case Dockerhub = 'dockerhub';
    case Wikipedia = 'wikipedia';
    case Internetarchive = 'internetarchive';
    case Spotify = 'spotify';
    case Patreon = 'patreon';
    case Wordpress = 'wordpress';
    case Okru = 'okru';
    case Flickr = 'flickr';
    case Synthetic = 'synthetic';
}
