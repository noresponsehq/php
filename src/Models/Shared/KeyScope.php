<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum KeyScope: string
{
    case Assess = 'assess';
    case History = 'history';
    case Delete = 'delete';
    case Webhooks = 'webhooks';
    case Detailed = 'detailed';
    case Integrations = 'integrations';
    case Management = 'management';
    case Audit = 'audit';
    case Usage = 'usage';
    case Investigate = 'investigate';
    case Evidence = 'evidence';
    case Exports = 'exports';
    case AuditManage = 'audit_manage';
    case Settings = 'settings';
    case PolicyPublish = 'policy_publish';
    case Members = 'members';
    case MembersManage = 'members_manage';
}
