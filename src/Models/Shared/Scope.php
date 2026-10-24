<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum Scope: string
{
    case Assess = 'assess';
    case History = 'history';
    case Delete = 'delete';
    case Webhooks = 'webhooks';
    case Detailed = 'detailed';
    case Integrations = 'integrations';
}
