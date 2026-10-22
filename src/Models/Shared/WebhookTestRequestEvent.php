<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** endpoint.verification sends a fresh challenge now, in this call, and the endpoint is verified if it echoes it. assessment.updated queues an event whose data is a fixed example assessment, with test true, delivered and retried like any other; the endpoint must be verified. */
enum WebhookTestRequestEvent: string
{
    case EndpointVerification = 'endpoint.verification';
    case AssessmentUpdated = 'assessment.updated';
}
