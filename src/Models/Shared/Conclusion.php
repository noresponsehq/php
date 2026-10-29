<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum Conclusion: string
{
    case Benign = 'benign';
    case Abuse = 'abuse';
    case Inconclusive = 'inconclusive';
}
