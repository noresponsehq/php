<?php

declare(strict_types=1);

namespace NoResponse\LateResults;

use Psr\Http\Client\ClientInterface;

/**
 * WorkOS User Management. revokeSessions pages through
 * GET /user_management/users/{id}/sessions and revokes each active one with
 * POST /user_management/sessions/revoke. WorkOS has no block or ban, so ban
 * revokes the sessions and then deletes the user
 * (DELETE /user_management/users/{id}); deletion is permanent.
 */
final class WorkosProvider implements LateResultProvider
{
    private readonly HttpCaller $call;

    /** @param  string  $apiKey  WorkOS API key (sk_...). $baseUrl defaults to https://api.workos.com. */
    public function __construct(string $apiKey, ?string $baseUrl = null, ?ClientInterface $http = null)
    {
        if ($apiKey === '') {
            throw new \InvalidArgumentException('WorkosProvider needs an API key');
        }
        $this->call = new HttpCaller('workos', $baseUrl ?? 'https://api.workos.com', 'Bearer '.$apiKey, $http);
    }

    public function name(): string
    {
        return 'workos';
    }

    public function revokeSessions(string $userId): void
    {
        $user = HttpCaller::segment($userId);
        $active = [];
        $after = null;
        for ($round = 0; $round < 1000; $round++) {
            $query = ['limit' => '100'];
            if ($after !== null) {
                $query['after'] = $after;
            }
            $body = $this->call->call('GET', "/user_management/users/{$user}/sessions", $query);
            HttpCaller::collectActive(HttpCaller::sessions($body), $active);
            $next = is_array($body) && is_array($body['list_metadata'] ?? null) ? ($body['list_metadata']['after'] ?? null) : null;
            if (! is_string($next) || $next === '') {
                break;
            }
            $after = $next;
        }
        foreach ($active as $id) {
            $this->call->call('POST', '/user_management/sessions/revoke', [], ['session_id' => $id]);
        }
    }

    public function ban(string $userId): void
    {
        $this->revokeSessions($userId);
        $this->call->call('DELETE', '/user_management/users/'.HttpCaller::segment($userId), [], null, true);
    }
}
