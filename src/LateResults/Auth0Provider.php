<?php

declare(strict_types=1);

namespace NoResponse\LateResults;

use Psr\Http\Client\ClientInterface;

/**
 * Auth0 Management API. revokeSessions deletes every session
 * (DELETE /users/{id}/sessions) and refresh token
 * (DELETE /users/{id}/refresh-tokens). ban first sets blocked: true
 * (PATCH /users/{id}), then does the same. A 404 on any call (user already
 * gone) counts as done, so a repeated delivery is safe.
 *
 * Auth0 offers the sessions and refresh-token endpoints on Enterprise plans
 * only; on other plans they answer 403 feature_not_enabled. Then refresh
 * tokens are deleted one by one through /device-credentials (types
 * refresh_token and rotating_refresh_token), which every plan has. A login
 * session cannot be ended, so revokeSessions blocks the user before deleting
 * the refresh tokens, and act() reports "ban". Unblock the user in the
 * dashboard to undo it. Any other refusal, such as 403 insufficient_scope,
 * throws.
 */
final class Auth0Provider implements LateResultActor
{
    private const PAGE = 100;

    private readonly HttpCaller $call;

    /**
     * @param  string  $token  A Management API access token with update:users, delete:sessions, delete:refresh_tokens,
     *                         read:device_credentials and delete:device_credentials.
     * @param  string|null  $domain  Your tenant domain, such as example.eu.auth0.com; the API is https://{domain}/api/v2.
     * @param  string|null  $baseUrl  The Management API base URL in place of $domain.
     */
    public function __construct(string $token, ?string $domain = null, ?string $baseUrl = null, ?ClientInterface $http = null)
    {
        if ($token === '') {
            throw new \InvalidArgumentException('Auth0Provider needs a token');
        }
        $base = $baseUrl ?? (($domain ?? '') !== '' ? "https://{$domain}/api/v2" : null);
        if ($base === null) {
            throw new \InvalidArgumentException('Auth0Provider needs a domain or a base URL');
        }
        $this->call = new HttpCaller('auth0', $base, 'Bearer '.$token, $http);
    }

    public function name(): string
    {
        return 'auth0';
    }

    public function revokeSessions(string $userId): void
    {
        $this->revoke($userId);
    }

    public function ban(string $userId): void
    {
        $user = HttpCaller::segment($userId);
        $this->block($user);
        // The block already ends a session the plan cannot delete.
        $this->deleteSessions($user);
        $this->deleteRefreshTokens($userId, $user);
    }

    /** Bans or revokes and returns the action that ran: "ban" when revoking had to block the user. */
    public function act(string $action, string $userId): string
    {
        if ($action === LateResultAction::BAN) {
            $this->ban($userId);

            return LateResultAction::BAN;
        }

        return $this->revoke($userId);
    }

    private function revoke(string $userId): string
    {
        $user = HttpCaller::segment($userId);
        $ended = $this->deleteSessions($user);
        // Without the sessions API a login session survives; blocking is the only way to end it.
        if (! $ended) {
            $this->block($user);
        }
        $this->deleteRefreshTokens($userId, $user);

        return $ended ? LateResultAction::REVOKE_SESSIONS : LateResultAction::BAN;
    }

    /** Auth0 answers 403 feature_not_enabled when the tenant's plan does not include an endpoint. */
    private static function notOnPlan(ProviderActionException $e): bool
    {
        return $e->status === 403 && $e->errorCode === 'feature_not_enabled';
    }

    private function block(string $user): void
    {
        $this->call->call('PATCH', "/users/{$user}", [], ['blocked' => true], true);
    }

    /** End every session; false when the plan has no sessions API. */
    private function deleteSessions(string $user): bool
    {
        try {
            $this->call->call('DELETE', "/users/{$user}/sessions", [], null, true);
        } catch (ProviderActionException $e) {
            if (self::notOnPlan($e)) {
                return false;
            }
            throw $e;
        }

        return true;
    }

    private function deleteRefreshTokens(string $userId, string $user): void
    {
        try {
            $this->call->call('DELETE', "/users/{$user}/refresh-tokens", [], null, true);

            return;
        } catch (ProviderActionException $e) {
            if (! self::notOnPlan($e)) {
                throw $e;
            }
        }
        // Collect every id before deleting any, so the pages do not shift underneath.
        $ids = [];
        foreach (['refresh_token', 'rotating_refresh_token'] as $type) {
            for ($page = 0; $page < 10; $page++) {
                $body = $this->call->call('GET', '/device-credentials', [
                    'user_id' => $userId,
                    'type' => $type,
                    'page' => (string) $page,
                    'per_page' => (string) self::PAGE,
                ], null, true);
                $listed = is_array($body) && array_is_list($body) ? $body : [];
                foreach ($listed as $credential) {
                    $id = is_array($credential) ? ($credential['id'] ?? null) : null;
                    if (is_string($id) && $id !== '') {
                        $ids[] = $id;
                    }
                }
                if (count($listed) < self::PAGE) {
                    break;
                }
            }
        }
        foreach ($ids as $id) {
            $this->call->call('DELETE', '/device-credentials/'.rawurlencode($id), [], null, true);
        }
    }
}
