<?php

declare(strict_types=1);

namespace NoResponse;

use NoResponse\Models\Shared\Assessment;
use NoResponse\Models\Shared\Status;

/** Wait for a pending assessment. Hand-written beside the generated client. */
final class Wait
{
    public const DEFAULT_TIMEOUT_SECONDS = 30.0;

    /**
     * Poll assessments->get until the assessment is no longer pending,
     * sleeping for the Retry-After the API sends (at least 1 s) between polls.
     *
     * @param  (callable(float): void)|null  $sleep  defaults to usleep
     * @param  (callable(): float)|null  $clock  monotonic seconds, defaults to hrtime
     *
     * @throws WaitTimeoutException once $timeoutSeconds have passed
     */
    public static function wait(
        NoResponseClient $client,
        string $assessmentId,
        float $timeoutSeconds = self::DEFAULT_TIMEOUT_SECONDS,
        ?callable $sleep = null,
        ?callable $clock = null,
    ): Assessment {
        if ($timeoutSeconds <= 0) {
            throw new \InvalidArgumentException('timeoutSeconds must be positive');
        }
        $sleep ??= static function (float $seconds): void {
            usleep((int) ($seconds * 1_000_000));
        };
        $clock ??= static fn (): float => hrtime(true) / 1e9;
        $deadline = $clock() + $timeoutSeconds;
        while (true) {
            $response = $client->assessments->get($assessmentId);
            if ($response->result->status !== Status::Pending) {
                return $response->result;
            }
            $delay = self::retryAfter($response->headers);
            if ($clock() + $delay > $deadline) {
                throw new WaitTimeoutException($assessmentId, $response->result);
            }
            $sleep($delay);
        }
    }

    /**
     * @param  array<string, array<string>>  $headers
     */
    private static function retryAfter(array $headers): float
    {
        foreach ($headers as $name => $values) {
            if (strcasecmp($name, 'retry-after') === 0 && isset($values[0]) && is_numeric($values[0])) {
                return max(1.0, (float) $values[0]);
            }
        }

        return 1.0;
    }
}
