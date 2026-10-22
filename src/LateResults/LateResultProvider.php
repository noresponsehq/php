<?php

declare(strict_types=1);

namespace NoResponse\LateResults;

/** The two admin actions for one auth provider: ClerkProvider, WorkosProvider or Auth0Provider. */
interface LateResultProvider
{
    public function name(): string;

    /** End every active session of the user. */
    public function revokeSessions(string $userId): void;

    /** Stop the user signing in again and end their sessions. */
    public function ban(string $userId): void;
}
