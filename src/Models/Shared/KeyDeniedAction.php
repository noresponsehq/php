<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum KeyDeniedAction: string
{
    case EvidenceRead = 'evidence.read';
    case ExportsRead = 'exports.read';
    case PolicyPublish = 'policy.publish';
}
