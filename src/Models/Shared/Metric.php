<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** assessments: assessments admitted. webhook_deliveries: events sent to endpoints, one per event per endpoint. key_usage_events: key-usage events accepted. */
enum Metric: string
{
    case Assessments = 'assessments';
    case WebhookDeliveries = 'webhook_deliveries';
    case KeyUsageEvents = 'key_usage_events';
}
