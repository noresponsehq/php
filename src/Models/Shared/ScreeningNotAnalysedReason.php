<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Why an item read was not analysed. video: a video, whose caption alone is read. image_unavailable: the image could not be fetched from the platform. image_unsupported: not a JPEG, PNG, GIF or WebP image, or too large to send. image_limit: past the most images one person's analysis reads. refused: the model declined to read it. unfinished: the model cut its batch short or answered outside the schema, or the request was rejected. unverified: a finding cited it with words it does not contain or an image it did not describe. unspecified: the analyser gave no reason. */
enum ScreeningNotAnalysedReason: string
{
    case Video = 'video';
    case ImageUnavailable = 'image_unavailable';
    case ImageUnsupported = 'image_unsupported';
    case ImageLimit = 'image_limit';
    case Refused = 'refused';
    case Unfinished = 'unfinished';
    case Unverified = 'unverified';
    case Unspecified = 'unspecified';
}
