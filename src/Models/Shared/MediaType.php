<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum MediaType: string
{
    case Image = 'image';
    case Video = 'video';
}
