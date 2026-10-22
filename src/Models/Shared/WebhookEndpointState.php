<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** unverified until the endpoint echoes an endpoint.verification challenge (send one with POST /v1/webhooks/{endpoint_id}/test); verified receives assessment.updated events; disabled after 72 hours of continuous delivery failure, and verified again by the same challenge. */
enum WebhookEndpointState: string
{
    case Unverified = 'unverified';
    case Verified = 'verified';
    case Disabled = 'disabled';
}
