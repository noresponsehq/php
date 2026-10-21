<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum LineType: string
{
    case Mobile = 'mobile';
    case Voip = 'voip';
    case Landline = 'landline';
    case TollFree = 'toll_free';
    case Other = 'other';
}
