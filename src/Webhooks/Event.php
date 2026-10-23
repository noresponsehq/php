<?php

declare(strict_types=1);

namespace NoResponse\Webhooks;

use NoResponse\Models\Shared\Assessment;

/**
 * A verified delivery. data is an Assessment (exactly as assessments->get
 * returns it) or an AssessmentExpired for type "assessment.updated", an
 * EndpointVerification for "endpoint.verification", an AccountDeleted for
 * "account.deleted", a TenantDeleted for "tenant.deleted" and an
 * EndpointDisabled for "webhook_endpoint.disabled". Deliveries are at least
 * once and unordered: deduplicate on id and keep the highest
 * assessmentVersion per assessment.
 *
 * test is true on an assessment.updated event sent by
 * webhookEndpoints->sendTestEvent: data is a fixed example assessment, not
 * one of yours, so acknowledge it and apply nothing.
 */
final class Event
{
    public function __construct(
        public readonly string $id,
        public readonly string $type,
        public readonly string $createdAt,
        public readonly Assessment|AssessmentExpired|EndpointVerification|AccountDeleted|TenantDeleted|EndpointDisabled $data,
        /**
         * True on an event sent by the send-test-event call: data is a fixed
         * example assessment, not one of yours. Acknowledge it and apply nothing.
         */
        public readonly bool $test = false,
    ) {
    }

    /** True for the terminal expiry event: delete what you hold and fetch nothing. */
    public function isExpired(): bool
    {
        return $this->data instanceof AssessmentExpired;
    }
}
