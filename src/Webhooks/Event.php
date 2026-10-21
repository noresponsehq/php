<?php

declare(strict_types=1);

namespace NoResponse\Webhooks;

use NoResponse\Models\Shared\Assessment;

/**
 * A verified delivery. data is an Assessment (exactly as assessments->get
 * returns it) or an AssessmentExpired for type "assessment.updated", and an
 * EndpointVerification for "endpoint.verification". Deliveries are at least
 * once and unordered: deduplicate on id and keep the highest
 * assessmentVersion per assessment.
 */
final class Event
{
    public function __construct(
        public readonly string $id,
        public readonly string $type,
        public readonly string $createdAt,
        public readonly Assessment|AssessmentExpired|EndpointVerification $data,
    ) {
    }

    /** True for the terminal expiry event: delete what you hold and fetch nothing. */
    public function isExpired(): bool
    {
        return $this->data instanceof AssessmentExpired;
    }
}
