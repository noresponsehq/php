<?php

declare(strict_types=1);

namespace NoResponse\LateResults;

/**
 * A provider that reports the action that ran. handleLateResult calls act()
 * when the provider implements it, and ban() or revokeSessions() otherwise.
 * A provider that has to do more than it was asked implements it:
 * Auth0Provider returns LateResultAction::BAN when the tenant's plan has no
 * sessions API and it blocked the user to end their sessions.
 */
interface LateResultActor extends LateResultProvider
{
    /**
     * Take $action (LateResultAction::REVOKE_SESSIONS or LateResultAction::BAN)
     * and return the action that ran.
     *
     * @throws ProviderActionException
     */
    public function act(string $action, string $userId): string;
}
