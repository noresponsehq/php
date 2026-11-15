<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** A NoResponse source: github (GitHub accounts), phone (the phone lookup), breach (breach exposure), rdap (the email domain's registration), mx (the email domain's mail servers), ipintel (IP intelligence) or an email account source that searches one platform for an account by email address (adobe, nvidia, wix, life360, zapier, x_email, snapchat_email, amazon, spotify_email, google, duolingo_email). x_email, snapchat_email, amazon and spotify_email only say whether the email has an account on X, Snapchat, Amazon or Spotify. google runs only for Gmail addresses. scratch, dailymotion, substack, duolingo, dockerhub, wikipedia, internetarchive, telegram, spotify, patreon, wordpress, okru and flickr each search that platform for an account by username; telegram also searches by phone number, through a logged-in Telegram lookup account. whatsapp searches WhatsApp for an account by phone number, and life360_phone searches Life360 for one. opplysningen (1881, Norway), ratsit (Sweden) and reverseaustralia (Australia) each look up a phone number of their own country on that site. youtube searches YouTube for a channel by username. */
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
    case Life360Phone = 'life360_phone';
    case Zapier = 'zapier';
    case XEmail = 'x_email';
    case SnapchatEmail = 'snapchat_email';
    case Amazon = 'amazon';
    case SpotifyEmail = 'spotify_email';
    case Google = 'google';
    case Scratch = 'scratch';
    case Dailymotion = 'dailymotion';
    case Substack = 'substack';
    case Duolingo = 'duolingo';
    case DuolingoEmail = 'duolingo_email';
    case Dockerhub = 'dockerhub';
    case Wikipedia = 'wikipedia';
    case Internetarchive = 'internetarchive';
    case Telegram = 'telegram';
    case Youtube = 'youtube';
    case Spotify = 'spotify';
    case Patreon = 'patreon';
    case Wordpress = 'wordpress';
    case Okru = 'okru';
    case Flickr = 'flickr';
    case Whatsapp = 'whatsapp';
    case Opplysningen = 'opplysningen';
    case Ratsit = 'ratsit';
    case Reverseaustralia = 'reverseaustralia';
}
