<?php

declare(strict_types=1);

namespace NoResponse\LateResults;

use Psr\Http\Client\ClientInterface;

/**
 * Clerk Backend API. revokeSessions lists the user's active sessions
 * (GET /sessions?user_id&status=active) and revokes each
 * (POST /sessions/{id}/revoke). ban is POST /users/{id}/ban, which revokes
 * every session and blocks sign-in.
 */
final class ClerkProvider implements LateResultProvider
{
    private const PAGE = 100;

    private readonly HttpCaller $call;

    /** @param  string  $secretKey  Clerk secret key (sk_...). $baseUrl defaults to https://api.clerk.com/v1. */
    public function __construct(string $secretKey, ?string $baseUrl = null, ?ClientInterface $http = null)
    {
        if ($secretKey === '') {
            throw new \InvalidArgumentException('ClerkProvider needs a secret key');
        }
        $this->call = new HttpCaller('clerk', $baseUrl ?? 'https://api.clerk.com/v1', 'Bearer '.$secretKey, $http);
    }

    public function name(): string
    {
        return 'clerk';
    }

    public function revokeSessions(string $userId): void
    {
        HttpCaller::segment($userId);
        $active = [];
        for ($offset = 0; $offset < self::PAGE * 1000; $offset += self::PAGE) {
            $page = HttpCaller::sessions($this->call->call('GET', '/sessions', [
                'user_id' => $userId, 'status' => 'active', 'limit' => (string) self::PAGE, 'offset' => (string) $offset,
            ]));
            HttpCaller::collectActive($page, $active);
            if (count($page) < self::PAGE) {
                break;
            }
        }
        foreach ($active as $id) {
            $this->call->call('POST', '/sessions/'.rawurlencode($id).'/revoke');
        }
    }

    public function ban(string $userId): void
    {
        $this->call->call('POST', '/users/'.HttpCaller::segment($userId).'/ban');
    }
}
