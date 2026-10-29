<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The kind of resource the change acted on. */
enum AuditEventTargetType: string
{
    case Workspace = 'workspace';
    case Member = 'member';
    case Invite = 'invite';
    case Key = 'key';
    case Setting = 'setting';
    case WebhookEndpoint = 'webhook_endpoint';
    case Integration = 'integration';
    case Billing = 'billing';
    case Review = 'review';
}
