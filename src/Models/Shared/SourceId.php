<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** A NoResponse source: github (GitHub accounts), phone (the phone lookup), breach (breach exposure), rdap (the email domain's registration), mx (the email domain's mail servers), ipintel (IP intelligence) or an email account source that searches one platform for an account by email address (adobe, nvidia, wix, life360, zapier, google). google runs only for Gmail addresses. scratch, dailymotion, substack, duolingo, dockerhub, wikipedia, internetarchive, telegram, spotify, patreon, wordpress, okru and flickr each search that platform for an account by username. */
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
    case Google = 'google';
    case Scratch = 'scratch';
    case Dailymotion = 'dailymotion';
    case Substack = 'substack';
    case Duolingo = 'duolingo';
    case Dockerhub = 'dockerhub';
    case Wikipedia = 'wikipedia';
    case Internetarchive = 'internetarchive';
    case Telegram = 'telegram';
    case Spotify = 'spotify';
    case Patreon = 'patreon';
    case Wordpress = 'wordpress';
    case Okru = 'okru';
    case Flickr = 'flickr';
}
