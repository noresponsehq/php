<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** delivered when the endpoint answered 2xx; failed otherwise, with failure naming why. */
enum WebhookDeliveryAttemptStatus: string
{
    case Delivered = 'delivered';
    case Failed = 'failed';
}
