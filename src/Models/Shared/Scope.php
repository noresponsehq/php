<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum Scope: string
{
    case Assess = 'assess';
    case History = 'history';
    case Webhooks = 'webhooks';
    case Detailed = 'detailed';
}
