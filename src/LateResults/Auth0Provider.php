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
 */
final class Auth0Provider implements LateResultProvider
{
    private readonly HttpCaller $call;

    /**
     * @param  string  $token  A Management API access token with update:users, delete:sessions and delete:refresh_tokens.
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
        $user = HttpCaller::segment($userId);
        $this->call->call('DELETE', "/users/{$user}/sessions", [], null, true);
        $this->call->call('DELETE', "/users/{$user}/refresh-tokens", [], null, true);
    }

    public function ban(string $userId): void
    {
        $this->call->call('PATCH', '/users/'.HttpCaller::segment($userId), [], ['blocked' => true], true);
        $this->revokeSessions($userId);
    }
}
