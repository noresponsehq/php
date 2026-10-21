<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Client platform. Closed vocabulary keeps integrations stable. */
enum Platform: string
{
    case Web = 'web';
    case Ios = 'ios';
    case Android = 'android';
    case Other = 'other';
}
