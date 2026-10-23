<?php

declare(strict_types=1);

namespace NoResponse\LateResults;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/** One provider's JSON-over-HTTP calls on a PSR-18 client. Internal to the provider classes. */
final class HttpCaller
{
    /*
     * Rate limits. Auth0 answers 429 when the Management API rate limit is hit, and a 429 means it did not act, so
     * the call is safe to send again, a DELETE included. One revoke or ban waits at most RATE_LIMIT_BUDGET seconds in
     * all, and each call retries at most RATE_LIMIT_RETRIES times: it waits Retry-After seconds, else until
     * X-RateLimit-Reset (Unix seconds), else 0.25, 0.5, 1 and 2 s. A wait that would pass the budget is not started:
     * the 429 throws at once as ProviderActionException, the webhook answers 5xx and NoResponse delivers it again
     * later. The budget keeps the handler inside the 5 s a delivery has to be answered.
     */
    public const RATE_LIMIT_RETRIES = 4;

    public const RATE_LIMIT_BUDGET = 3.0;

    public const RATE_LIMIT_BACKOFF = 0.25;

    private readonly string $base;

    private readonly ClientInterface $http;

    /** Seconds spent waiting out 429s so far, in one action. */
    private float $waited = 0.0;

    public function __construct(
        private readonly string $provider,
        string $baseUrl,
        private readonly string $authorization,
        ?ClientInterface $http,
        private readonly bool $retryRateLimits = false,
    ) {
        $this->base = rtrim($baseUrl, '/');
        $this->http = $http ?? new Client(['http_errors' => false, 'timeout' => 15]);
    }

    /** A caller with the same settings that waits out 429s, with its own budget: make one per action. */
    public function retryingRateLimits(): self
    {
        return new self($this->provider, $this->base, $this->authorization, $this->http, true);
    }

    /** How long a 429 asks to wait, in seconds. */
    public static function rateLimitWait(ResponseInterface $response, int $retry): float
    {
        $after = self::number($response->getHeaderLine('Retry-After'));
        if ($after !== null && $after >= 0) {
            return $after;
        }
        $reset = self::number($response->getHeaderLine('X-RateLimit-Reset'));
        if ($reset !== null) {
            return max(0.0, $reset - microtime(true));
        }

        return self::RATE_LIMIT_BACKOFF * (2 ** $retry);
    }

    private static function number(string $text): ?float
    {
        $text = trim($text);
        if ($text === '' || ! is_numeric($text)) {
            return null;
        }
        $value = (float) $text;

        return is_finite($value) ? $value : null;
    }

    public static function segment(string $id): string
    {
        if ($id === '') {
            throw new \InvalidArgumentException('user id must be a non-empty string');
        }

        return rawurlencode($id);
    }

    /**
     * @param  array<string, string>  $query
     * @param  array<string, mixed>|null  $body
     * @return mixed the decoded JSON body, or null when there is none (or on an allowed 404)
     *
     * @throws ProviderActionException
     */
    public function call(string $method, string $path, array $query = [], ?array $body = null, bool $allow404 = false): mixed
    {
        $url = $this->base.$path.($query === [] ? '' : '?'.http_build_query($query, '', '&', PHP_QUERY_RFC3986));
        $headers = ['Authorization' => $this->authorization, 'Accept' => 'application/json'];
        $payload = null;
        if ($body !== null) {
            $headers['Content-Type'] = 'application/json';
            $payload = json_encode($body, JSON_THROW_ON_ERROR);
        }
        for ($retry = 0; ; $retry++) {
            $response = $this->send(new Request($method, $url, $headers, $payload));
            if ($response->getStatusCode() !== 429 || ! $this->retryRateLimits || $retry >= self::RATE_LIMIT_RETRIES) {
                break;
            }
            $wait = self::rateLimitWait($response, $retry);
            if ($this->waited + $wait > self::RATE_LIMIT_BUDGET) {
                break;
            }
            $this->waited += $wait;
            usleep((int) round($wait * 1_000_000));
        }
        $status = $response->getStatusCode();
        if ($allow404 && $status === 404) {
            return null;
        }
        $text = (string) $response->getBody();
        if ($status < 200 || $status > 299) {
            throw new ProviderActionException($this->provider, $status, "{$this->provider} {$method} {$path} answered {$status}", self::errorCode($text));
        }
        if ($text === '') {
            return null;
        }
        try {
            return json_decode($text, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return null;
        }
    }

    private function send(Request $request): ResponseInterface
    {
        try {
            return $this->http->sendRequest($request);
        } catch (\Throwable $e) {
            // A client configured to throw on 4xx/5xx still carries the response.
            $response = method_exists($e, 'getResponse') ? $e->getResponse() : null;
            if (! $response instanceof ResponseInterface) {
                throw $e;
            }

            return $response;
        }
    }

    /** The error code in a provider's error body: Auth0's errorCode, or a top-level code. */
    public static function errorCode(string $text): ?string
    {
        try {
            $body = json_decode($text, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return null;
        }
        if (! is_array($body)) {
            return null;
        }
        foreach (['errorCode', 'code'] as $field) {
            if (isset($body[$field]) && is_string($body[$field]) && $body[$field] !== '') {
                return $body[$field];
            }
        }

        return null;
    }

    /**
     * Sessions in a list body: a bare array or {"data": [...]}.
     *
     * @return list<array<mixed>>
     */
    public static function sessions(mixed $body): array
    {
        if (! is_array($body)) {
            return [];
        }
        $list = array_is_list($body) ? $body : ($body['data'] ?? []);

        return is_array($list) ? array_values(array_filter($list, 'is_array')) : [];
    }

    /**
     * @param  list<array<mixed>>  $page
     * @param  list<string>  $into
     */
    public static function collectActive(array $page, array &$into): void
    {
        foreach ($page as $session) {
            $id = $session['id'] ?? null;
            if (($session['status'] ?? null) === 'active' && is_string($id) && $id !== '') {
                $into[] = $id;
            }
        }
    }
}
