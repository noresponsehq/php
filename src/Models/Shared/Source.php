<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum Source: string
{
    case Requests = 'requests';
    case WebhookAttempts = 'webhook_attempts';
}
