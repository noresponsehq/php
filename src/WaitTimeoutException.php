<?php

declare(strict_types=1);

namespace NoResponse;

use NoResponse\Models\Shared\Assessment;

/**
 * The assessment was still pending when the wait ran out. last is the pending
 * assessment from the final poll; the webhook delivers the result when it
 * settles.
 */
final class WaitTimeoutException extends \RuntimeException
{
    public function __construct(public readonly string $assessmentId, public readonly Assessment $last)
    {
        parent::__construct("Assessment {$assessmentId} is still pending");
    }
}
