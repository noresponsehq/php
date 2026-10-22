<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WebhookKeyRotationRequest - POST /v1/webhooks/{endpoint_id}/rotate body: an empty object. The old key keeps verifying for 7 days. */
class WebhookKeyRotationRequest
{

    public function __construct()
    {
    }
}