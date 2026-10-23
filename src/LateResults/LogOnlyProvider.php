<?php

declare(strict_types=1);

namespace NoResponse\LateResults;

/**
 * A provider for an app with its own login, or for trying the handler before
 * you wire up a real one. revokeSessions and ban each log one line saying what
 * they would do and call nothing: no request leaves your process. Replace it
 * with your own LateResultProvider once you know what revoking and banning
 * mean in your app.
 */
final class LogOnlyProvider implements LateResultProvider
{
    /** @var \Closure(string): void */
    private readonly \Closure $log;

    /** @param  (callable(string): void)|null  $log  receives each line; defaults to error_log(). */
    public function __construct(?callable $log = null)
    {
        $this->log = $log !== null
            ? \Closure::fromCallable($log)
            : static function (string $message): void {
                error_log($message);
            };
    }

    public function name(): string
    {
        return 'log_only';
    }

    public function revokeSessions(string $userId): void
    {
        HttpCaller::segment($userId);
        ($this->log)("NoResponse late result (log only): would revoke every session of user {$userId}");
    }

    public function ban(string $userId): void
    {
        HttpCaller::segment($userId);
        ($this->log)("NoResponse late result (log only): would ban user {$userId} and end their sessions");
    }
}
