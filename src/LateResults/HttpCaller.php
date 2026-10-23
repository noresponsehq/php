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
    private readonly string $base;

    private readonly ClientInterface $http;

    public function __construct(
        private readonly string $provider,
        string $baseUrl,
        private readonly string $authorization,
        ?ClientInterface $http,
    ) {
        $this->base = rtrim($baseUrl, '/');
        $this->http = $http ?? new Client(['http_errors' => false, 'timeout' => 15]);
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
        try {
            $response = $this->http->sendRequest(new Request($method, $url, $headers, $payload));
        } catch (\Throwable $e) {
            // A client configured to throw on 4xx/5xx still carries the response.
            $response = method_exists($e, 'getResponse') ? $e->getResponse() : null;
            if (! $response instanceof ResponseInterface) {
                throw $e;
            }
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
