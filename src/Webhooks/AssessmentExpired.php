<?php

declare(strict_types=1);

namespace NoResponse\Webhooks;

/**
 * The final event for an assessment: it has expired and get now answers 404.
 * assessmentVersion is the last served version; expiry is not a revision.
 */
final class AssessmentExpired
{
    public readonly string $status;

    public readonly string $changeReason;

    public function __construct(
        public readonly string $assessmentId,
        public readonly string $accountId,
        public readonly int $assessmentVersion,
    ) {
        $this->status = 'expired';
        $this->changeReason = 'expired';
    }
}
