<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use GuzzleHttp\Psr7\Response;
use NoResponse\LateResults\Auth0Provider;
use NoResponse\LateResults\ClerkProvider;
use NoResponse\LateResults\LateResultAction;
use NoResponse\LateResults\LateResultProvider;
use NoResponse\LateResults\LateResults;
use NoResponse\LateResults\LogOnlyProvider;
use NoResponse\LateResults\ProviderActionException;
use NoResponse\LateResults\WorkosProvider;
use NoResponse\Webhooks\AssessmentExpired;
use NoResponse\Webhooks\Event;
use NoResponse\Webhooks\VerificationException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class LateResultsTest extends TestCase
{
    private const SECRET = 'late-result-secret';
    private const KEY = 'whk_sdktest01';
    private const NOW = 1791968402;
    private const EVENT_ID = 'evt_01JA2ZB4N5P6Q7R8S9T0VWXYZ2';

    /** @var resource|null */
    private $process = null;

    private string $dir = '';

    private string $url = '';

    protected function setUp(): void
    {
        $this->dir = sys_get_temp_dir().'/nr-tmp-late-'.bin2hex(random_bytes(6));
        mkdir($this->dir);
        file_put_contents($this->dir.'/router.php', self::ROUTER);
        $probe = stream_socket_server('tcp://127.0.0.1:0', $errno, $error);
        $this->assertNotFalse($probe, (string) $error);
        $port = (int) substr((string) strrchr((string) stream_socket_get_name($probe, false), ':'), 1);
        fclose($probe);
        $this->process = proc_open(
            [PHP_BINARY, '-S', "127.0.0.1:{$port}", $this->dir.'/router.php'],
            [0 => ['file', '/dev/null', 'r'], 1 => ['file', '/dev/null', 'w'], 2 => ['file', '/dev/null', 'w']],
            $pipes,
            $this->dir,
            ['NR_CALLS' => $this->dir.'/calls.jsonl'],
        );
        $this->assertIsResource($this->process);
        for ($i = 0; $i < 100; $i++) {
            $conn = @fsockopen('127.0.0.1', $port, $errno, $error, 0.2);
            if ($conn !== false) {
                fclose($conn);
                $this->url = "http://127.0.0.1:{$port}";

                return;
            }
            usleep(50_000);
        }
        $this->fail('mock provider did not start');
    }

    protected function tearDown(): void
    {
        if (is_resource($this->process)) {
            proc_terminate($this->process);
            proc_close($this->process);
        }
        foreach (glob($this->dir.'/*') ?: [] as $file) {
            unlink($file);
        }
        rmdir($this->dir);
    }

    /**
     * The mock provider API: records each request, answers by path. A /forbid prefix refuses every DELETE with 403;
     * /gone answers 404 to everything, /vanish lists one session then answers 404, /broken answers 500.
     * /free is an Auth0 tenant without the sessions API (/freert: with the refresh-token endpoint), keeping its
     * state in free.json; /scope refuses every DELETE with 403 insufficient_scope.
     */
    private const ROUTER = <<<'PHP'
<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
$raw = file_get_contents('php://input');
$headers = array_change_key_case(getallheaders(), CASE_LOWER);
file_put_contents(getenv('NR_CALLS'), json_encode([
    'method' => $method, 'path' => $path, 'query' => $_GET, 'auth' => $headers['authorization'] ?? null,
    'accept' => $headers['accept'] ?? null, 'content_type' => $headers['content-type'] ?? null,
    'body' => $raw === '' ? null : json_decode($raw, true),
])."\n", FILE_APPEND);
function reply(int $status, $body = null): void
{
    http_response_code($status);
    header('Content-Type: application/json');
    if ($body !== null) {
        echo json_encode($body);
    }
    exit;
}
if (str_starts_with($path, '/gone')) {
    reply(404, ['message' => 'not found']);
}
if (str_starts_with($path, '/vanish')) {
    $method === 'GET' ? reply(200, [['id' => 'sess_1', 'status' => 'active']]) : reply(404);
}
if (str_starts_with($path, '/broken')) {
    reply(500, ['error' => 'boom']);
}
if (str_starts_with($path, '/forbid') && $method === 'DELETE') {
    reply(403, ['error' => 'insufficient_scope secret-body']);
}
if ($method === 'GET' && $path === '/v1/sessions') {
    reply(200, ($_GET['offset'] ?? '') === '0' ? [['id' => 'sess_1', 'status' => 'active'], ['id' => 'sess_2', 'status' => 'active']] : []);
}
if ($method === 'POST' && preg_match('#^/v1/sessions/(sess_\d)/revoke$#', $path, $m)) {
    reply(200, ['id' => $m[1], 'status' => 'revoked']);
}
if ($method === 'POST' && $path === '/v1/users/user_2EXAMPLE/ban') {
    reply(200, ['id' => 'user_2EXAMPLE', 'banned' => true]);
}
if ($method === 'GET' && $path === '/user_management/users/user_01WORKOS/sessions') {
    if (!isset($_GET['after'])) {
        reply(200, ['object' => 'list', 'data' => [['id' => 'session_A', 'status' => 'active'], ['id' => 'session_X', 'status' => 'revoked']], 'list_metadata' => ['before' => null, 'after' => 'session_X']]);
    }
    reply(200, ['object' => 'list', 'data' => [['id' => 'session_B', 'status' => 'active']], 'list_metadata' => ['before' => 'session_B', 'after' => null]]);
}
if ($method === 'POST' && $path === '/user_management/sessions/revoke') {
    reply(200, ['status' => 'revoked']);
}
if ($method === 'DELETE' && $path === '/user_management/users/user_01WORKOS') {
    reply(202);
}
if (preg_match('#^/(free|freert)(/api/v2/.*)$#', $path, $m)) {
    // An Auth0 tenant on a plan without the sessions API, as a Free tenant answers: both bulk endpoints refuse with
    // 403 feature_not_enabled, while /device-credentials and PATCH /users/{id} work.
    $file = dirname(getenv('NR_CALLS')).'/free.json';
    $state = is_file($file) ? json_decode(file_get_contents($file), true) : ['blocked' => false, 'credentials' => [['id' => 'dcr_a', 'type' => 'refresh_token'], ['id' => 'dcr_b', 'type' => 'refresh_token'], ['id' => 'dcr_r', 'type' => 'rotating_refresh_token']]];
    $save = static function () use (&$state, $file): void { file_put_contents($file, json_encode($state)); };
    $refused = ['statusCode' => 403, 'error' => 'Forbidden', 'message' => 'This feature is not enabled for this tenant.', 'errorCode' => 'feature_not_enabled'];
    $rest = $m[2];
    if ($method === 'DELETE' && preg_match('#^/api/v2/users/[^/]+/sessions$#', $rest)) {
        reply(403, $refused);
    }
    if ($method === 'DELETE' && preg_match('#^/api/v2/users/[^/]+/refresh-tokens$#', $rest)) {
        if ($m[1] === 'free') {
            reply(403, $refused);
        }
        $state['credentials'] = [];
        $save();
        reply(202);
    }
    if ($method === 'PATCH' && preg_match('#^/api/v2/users/[^/]+$#', $rest)) {
        $state['blocked'] = json_decode($raw, true)['blocked'] === true;
        $save();
        reply(200, ['blocked' => $state['blocked']]);
    }
    if ($method === 'GET' && $rest === '/api/v2/device-credentials') {
        reply(200, array_values(array_filter($state['credentials'], static fn ($d) => $d['type'] === ($_GET['type'] ?? null))));
    }
    if ($method === 'DELETE' && preg_match('#^/api/v2/device-credentials/(.+)$#', $rest, $d)) {
        $before = count($state['credentials']);
        $state['credentials'] = array_values(array_filter($state['credentials'], static fn ($c) => $c['id'] !== $d[1]));
        $save();
        count($state['credentials']) < $before ? reply(204) : reply(404, ['errorCode' => 'inexistent_device_credential']);
    }
    reply(404, ['error' => 'not found']);
}
if (str_starts_with($path, '/scope') && $method === 'DELETE') {
    reply(403, ['statusCode' => 403, 'error' => 'Forbidden', 'message' => 'Insufficient scope', 'errorCode' => 'insufficient_scope']);
}
$escaped = 'auth0%7C64abc0de1234567890abcdef';
if ($method === 'DELETE' && in_array($path, ["/api/v2/users/{$escaped}/sessions", "/api/v2/users/{$escaped}/refresh-tokens"], true)) {
    reply(202);
}
if ($method === 'PATCH' && $path === "/api/v2/users/{$escaped}") {
    reply(200, ['user_id' => 'auth0|64abc0de1234567890abcdef', 'blocked' => json_decode($raw, true)['blocked']]);
}
reply(404, ['error' => 'not found']);
PHP;

    /** @return list<array<string, mixed>> */
    private function calls(): array
    {
        $file = $this->dir.'/calls.jsonl';
        $lines = is_file($file) ? array_filter(explode("\n", (string) file_get_contents($file))) : [];

        return array_values(array_map(static fn (string $l): array => json_decode($l, true, 512, JSON_THROW_ON_ERROR), $lines));
    }

    private function resetCalls(): void
    {
        @unlink($this->dir.'/calls.jsonl');
    }

    /** @param  list<array<string, mixed>>  $calls @return list<string> */
    private static function lines(array $calls): array
    {
        return array_map(static fn (array $c): string => $c['method'].' '.$c['path'], $calls);
    }

    private static function fixture(string $name): \stdClass
    {
        return json_decode((string) file_get_contents(__DIR__.'/fixtures/'.$name), false, 512, JSON_THROW_ON_ERROR);
    }

    /** @return array{string, array<string, string>} */
    private static function delivery(\stdClass $data, ?string $accountId = null, bool $test = false): array
    {
        if ($accountId !== null) {
            $data = json_decode(json_encode($data, JSON_THROW_ON_ERROR), false, 512, JSON_THROW_ON_ERROR);
            $data->detail->account_id = $accountId;
            if (isset($data->account)) {
                $data->account->id = $accountId;
            }
        }
        $body = ['id' => self::EVENT_ID, 'type' => 'assessment.updated', 'created_at' => '2026-10-18T11:00:04Z'];
        if ($test) {
            $body['test'] = true;
        }
        $body['data'] = $data;
        $raw = json_encode($body, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
        $stamp = (string) self::NOW;

        return [$raw, [
            'NR-Webhook-Id' => self::EVENT_ID,
            'NR-Webhook-Timestamp' => $stamp,
            'NR-Webhook-Key-Id' => self::KEY,
            'NR-Webhook-Signature' => 'v1='.hash_hmac('sha256', $stamp.'.'.$raw, self::SECRET),
        ]];
    }

    /** @return array<string, string> */
    private static function secrets(): array
    {
        return [self::KEY => self::SECRET];
    }

    /** Build a typed event through the real verifier. */
    private static function event(\stdClass $data): Event
    {
        [$raw, $headers] = self::delivery($data);
        $provider = new class implements LateResultProvider {
            public function name(): string
            {
                return 'null';
            }

            public function revokeSessions(string $userId): void
            {
            }

            public function ban(string $userId): void
            {
            }
        };

        return LateResults::handleLateResult($raw, $headers, self::secrets(), $provider, now: self::NOW)->event;
    }

    /** An assessment with this status whose account carries this decision. */
    private static function data(string $status, string $decision): \stdClass
    {
        $data = self::fixture('valid/assessment-view-complete.json');
        $data->status = $status;
        $data->detail->status = $status;
        $data->account->risk->decision = $decision;
        foreach (['signup', 'login', 'purchase'] as $flow) {
            $data->account->decisions_by_flow->{$flow} = $decision;
        }

        return $data;
    }

    public function test_default_policy_revokes_on_review_or_block_and_does_nothing_on_allow_step_up_pending_or_expiry(): void
    {
        $review = self::event(self::data('complete', 'review'));
        $stepUp = self::event(self::data('complete', 'step_up'));
        $block = self::event(self::fixture('valid/assessment-view-block.json'));
        $allow = self::event(self::fixture('valid/assessment-view-complete.json'));
        $pending = self::event(self::fixture('valid/assessment-view-pending.json'));
        $pendingKnown = self::event(self::fixture('valid/assessment-view-pending-known-account.json'));
        $expired = self::event(self::fixture('valid/webhook-assessment-expired.json')->data);
        $this->assertInstanceOf(AssessmentExpired::class, $expired->data);

        $this->assertSame('revoke_sessions', LateResults::lateResultAction($review));
        $this->assertSame('revoke_sessions', LateResults::lateResultAction($block));
        $this->assertSame('none', LateResults::lateResultAction($stepUp));
        $this->assertSame('none', LateResults::lateResultAction($allow));
        $this->assertSame('none', LateResults::lateResultAction($pending));
        // A pending assessment of a known account carries the earlier decision; it never acts.
        $this->assertSame('none', LateResults::lateResultAction($pendingKnown, ['allow' => 'ban']));
        $this->assertSame('none', LateResults::lateResultAction(self::event(self::data('pending', 'review'))));
        $this->assertSame('ban', LateResults::lateResultAction($block, ['block' => 'ban']));
        $this->assertSame('none', LateResults::lateResultAction($expired));
        $this->assertSame('none', LateResults::lateResultAction(self::event(self::data('partial', 'allow'))));
        $this->assertSame('none', LateResults::lateResultAction(new Event('evt_x', 'endpoint.verification', 'x', new \NoResponse\Webhooks\EndpointVerification('whe_x', 'y'))));
        $this->assertSame('none', LateResults::lateResultAction(new Event('evt_x', 'account.deleted', 'x', new \NoResponse\Webhooks\AccountDeleted('acct_1', 1, 'x'))));
        $this->assertSame('none', LateResults::lateResultAction(new Event('evt_x', 'tenant.deleted', 'x', new \NoResponse\Webhooks\TenantDeleted('tnt_1', 'live', 'x'))));
        $this->assertSame('none', LateResults::lateResultAction(new Event('evt_x', 'webhook_endpoint.disabled', 'x', new \NoResponse\Webhooks\EndpointDisabled('whe_1', 'x', 'x'))));
        $this->assertSame('ban', LateResults::lateResultAction($stepUp, ['step_up' => 'ban']));
        $this->assertSame('none', LateResults::lateResultAction($review, ['step_up' => 'ban']));
        try {
            LateResults::lateResultAction($review, ['review' => 'delete']);
            $this->fail('expected InvalidArgumentException');
        } catch (\InvalidArgumentException) {
            $this->addToAssertionCount(1);
        }
        $this->assertSame(['allow' => 'none', 'step_up' => 'none', 'review' => 'revoke_sessions', 'block' => 'revoke_sessions'], LateResults::DEFAULT_POLICY);
        $this->assertSame(['none', 'revoke_sessions', 'ban'], LateResultAction::ALL);
    }

    public function test_clerk_review_revokes_each_active_session_and_a_ban_policy_bans_the_user(): void
    {
        $clerk = new ClerkProvider('sk_test_mock', $this->url.'/v1');
        [$raw, $headers] = self::delivery(self::data('complete', 'review'), 'user_2EXAMPLE');
        $result = LateResults::handleLateResult($raw, $headers, self::secrets(), $clerk, now: self::NOW);
        $this->assertSame('revoke_sessions', $result->action);
        $this->assertSame('user_2EXAMPLE', $result->userId);
        $this->assertSame(self::data('complete', 'review')->id, $result->event->data->id);
        $this->assertSame('user_2EXAMPLE', $result->event->data->detail->accountId);
        $calls = $this->calls();
        $this->assertSame(['GET /v1/sessions', 'POST /v1/sessions/sess_1/revoke', 'POST /v1/sessions/sess_2/revoke'], self::lines($calls));
        $this->assertSame(['user_id' => 'user_2EXAMPLE', 'status' => 'active', 'limit' => '100', 'offset' => '0'], $calls[0]['query']);
        foreach ($calls as $c) {
            $this->assertSame('Bearer sk_test_mock', $c['auth']);
            $this->assertSame('application/json', $c['accept']);
        }

        $this->resetCalls();
        $banned = LateResults::handleLateResult($raw, $headers, self::secrets(), $clerk, policy: ['review' => 'ban'], now: self::NOW);
        $this->assertSame('ban', $banned->action);
        $this->assertSame(['POST /v1/users/user_2EXAMPLE/ban'], self::lines($this->calls()));
    }

    public function test_workos_revoke_pages_through_the_sessions_and_ban_revokes_then_deletes_the_user(): void
    {
        $workos = new WorkosProvider('sk_test_workos', $this->url);
        [$raw, $headers] = self::delivery(self::data('complete', 'step_up'), 'acct_7f3a9c');
        $result = LateResults::handleLateResult(
            $raw,
            $headers,
            self::secrets(),
            $workos,
            policy: ['step_up' => 'ban'],
            userId: static fn (string $accountId): ?string => $accountId === 'acct_7f3a9c' ? 'user_01WORKOS' : null,
            now: self::NOW,
        );
        $this->assertSame('ban', $result->action);
        $this->assertSame('user_01WORKOS', $result->userId);
        $calls = $this->calls();
        $this->assertSame(
            [
                'GET /user_management/users/user_01WORKOS/sessions {"limit":"100"}',
                'GET /user_management/users/user_01WORKOS/sessions {"limit":"100","after":"session_X"}',
                'POST /user_management/sessions/revoke {"session_id":"session_A"}',
                'POST /user_management/sessions/revoke {"session_id":"session_B"}',
                'DELETE /user_management/users/user_01WORKOS []',
            ],
            array_map(static fn (array $c): string => $c['method'].' '.$c['path'].' '.json_encode($c['body'] ?? $c['query']), $calls),
        );
        foreach ($calls as $c) {
            $this->assertSame('Bearer sk_test_workos', $c['auth']);
            $this->assertSame($c['body'] === null ? null : 'application/json', $c['content_type']);
        }
    }

    public function test_auth0_review_deletes_sessions_and_refresh_tokens_ban_blocks_first_and_the_pipe_is_escaped(): void
    {
        $id = 'auth0|64abc0de1234567890abcdef';
        $escaped = 'auth0%7C64abc0de1234567890abcdef';
        $auth0 = new Auth0Provider('mgmt_token', baseUrl: $this->url.'/api/v2');
        [$raw, $headers] = self::delivery(self::data('complete', 'review'), $id);
        $result = LateResults::handleLateResult($raw, $headers, self::secrets(), $auth0, now: self::NOW);
        $this->assertSame('revoke_sessions', $result->action);
        $this->assertSame($id, $result->userId);
        $this->assertSame(["DELETE /api/v2/users/{$escaped}/sessions", "DELETE /api/v2/users/{$escaped}/refresh-tokens"], self::lines($this->calls()));

        $this->resetCalls();
        LateResults::handleLateResult($raw, $headers, self::secrets(), $auth0, policy: ['review' => 'ban'], now: self::NOW);
        $calls = $this->calls();
        $this->assertSame(
            ["PATCH /api/v2/users/{$escaped}", "DELETE /api/v2/users/{$escaped}/sessions", "DELETE /api/v2/users/{$escaped}/refresh-tokens"],
            self::lines($calls),
        );
        $this->assertSame(['blocked' => true], $calls[0]['body']);
        $this->assertSame('application/json', $calls[0]['content_type']);
        $this->assertNull($calls[1]['body']);
        foreach ($calls as $c) {
            $this->assertSame('Bearer mgmt_token', $c['auth']);
        }
    }

    /** @return array{blocked: bool, credentials: list<array{id: string, type: string}>} */
    private function freeTenant(): array
    {
        return json_decode((string) file_get_contents($this->dir.'/free.json'), true, 512, JSON_THROW_ON_ERROR);
    }

    /** @param  array{blocked: bool, credentials: list<array{id: string, type: string}>}  $state */
    private function setFreeTenant(array $state): void
    {
        file_put_contents($this->dir.'/free.json', json_encode($state));
    }

    public function test_auth0_without_the_sessions_api_blocks_deletes_device_credentials_and_reports_ban(): void
    {
        $id = 'auth0|64abc0de1234567890abcdef';
        $escaped = 'auth0%7C64abc0de1234567890abcdef';
        $auth0 = new Auth0Provider('mgmt_token', baseUrl: $this->url.'/free/api/v2');
        [$raw, $headers] = self::delivery(self::data('complete', 'review'), $id);

        $result = LateResults::handleLateResult($raw, $headers, self::secrets(), $auth0, now: self::NOW);
        $this->assertSame('ban', $result->action);
        $this->assertSame($id, $result->userId);
        $this->assertSame(['blocked' => true, 'credentials' => []], $this->freeTenant());
        $calls = $this->calls();
        $this->assertSame([
            "DELETE /free/api/v2/users/{$escaped}/sessions",
            "PATCH /free/api/v2/users/{$escaped}",
            "DELETE /free/api/v2/users/{$escaped}/refresh-tokens",
            'GET /free/api/v2/device-credentials',
            'GET /free/api/v2/device-credentials',
            'DELETE /free/api/v2/device-credentials/dcr_a',
            'DELETE /free/api/v2/device-credentials/dcr_b',
            'DELETE /free/api/v2/device-credentials/dcr_r',
        ], self::lines($calls));
        $this->assertSame(['refresh_token', 'rotating_refresh_token'], [$calls[3]['query']['type'], $calls[4]['query']['type']]);
        $this->assertSame($id, $calls[3]['query']['user_id']);
        foreach ($calls as $c) {
            $this->assertSame('Bearer mgmt_token', $c['auth']);
        }

        // The same delivery again: still blocked, nothing left to delete, same report.
        $this->resetCalls();
        $this->assertSame('ban', LateResults::handleLateResult($raw, $headers, self::secrets(), $auth0, now: self::NOW)->action);
        $this->assertTrue($this->freeTenant()['blocked']);
        foreach ($this->calls() as $c) {
            $this->assertFalse($c['method'] === 'DELETE' && str_starts_with($c['path'], '/free/api/v2/device-credentials/'), $c['path']);
        }

        // ban blocks first, and the plan refusing the sessions endpoint is no failure.
        $this->setFreeTenant(['blocked' => false, 'credentials' => [['id' => 'dcr_c', 'type' => 'refresh_token']]]);
        $this->resetCalls();
        $banned = LateResults::handleLateResult($raw, $headers, self::secrets(), $auth0, policy: ['review' => 'ban'], now: self::NOW);
        $this->assertSame('ban', $banned->action);
        $this->assertSame('PATCH', $this->calls()[0]['method']);
        $this->assertSame(['blocked' => true, 'credentials' => []], $this->freeTenant());

        // Called directly, revokeSessions takes the same fallback.
        $this->setFreeTenant(['blocked' => false, 'credentials' => []]);
        $auth0->revokeSessions($id);
        $this->assertTrue($this->freeTenant()['blocked']);
    }

    public function test_auth0_with_refresh_tokens_but_no_sessions_api_still_blocks_and_a_scope_refusal_never_falls_back(): void
    {
        [$raw, $headers] = self::delivery(self::data('complete', 'review'), 'auth0|abc');
        $result = LateResults::handleLateResult($raw, $headers, self::secrets(), new Auth0Provider('t', baseUrl: $this->url.'/freert/api/v2'), now: self::NOW);
        $this->assertSame('ban', $result->action);
        $this->assertTrue($this->freeTenant()['blocked']);
        $this->assertNotContains('GET /freert/api/v2/device-credentials', self::lines($this->calls()));

        $this->resetCalls();
        try {
            LateResults::handleLateResult($raw, $headers, self::secrets(), new Auth0Provider('t', baseUrl: $this->url.'/scope/api/v2'), now: self::NOW);
            $this->fail('a scope refusal must throw');
        } catch (ProviderActionException $e) {
            $this->assertSame(403, $e->status);
            $this->assertSame('insufficient_scope', $e->errorCode);
        }
        $this->assertSame(['DELETE /scope/api/v2/users/auth0%7Cabc/sessions'], self::lines($this->calls()));
    }

    private const TOO_MANY = '{"statusCode":429,"error":"Too Many Requests","message":"Global limit has been reached","errorCode":"too_many_requests"}';

    /**
     * A PSR-18 client standing in for the Management API: it answers each request from $answer and records it.
     *
     * @param  callable(RequestInterface): ResponseInterface  $answer
     */
    private static function stubClient(callable $answer): ClientInterface
    {
        return new class($answer) implements ClientInterface
        {
            /** @var list<string> */
            public array $sent = [];

            /** @var callable(RequestInterface): ResponseInterface */
            private $answer;

            public function __construct(callable $answer)
            {
                $this->answer = $answer;
            }

            public function sendRequest(RequestInterface $request): ResponseInterface
            {
                $this->sent[] = $request->getMethod().' '.$request->getUri()->getPath().($request->getMethod() === 'GET' ? ' '.self::type($request) : '');

                return ($this->answer)($request);
            }

            private static function type(RequestInterface $request): string
            {
                parse_str($request->getUri()->getQuery(), $query);

                return is_string($query['type'] ?? null) ? $query['type'] : '';
            }
        };
    }

    public function test_auth0_waits_out_a_429_from_the_management_api_and_retries_the_call(): void
    {
        $credentials = ['refresh_token' => ['dcr_a', 'dcr_b'], 'rotating_refresh_token' => []];
        // One 429 each: Retry-After, an X-RateLimit-Reset already past, and no header (the backoff).
        $limited = [
            'GET /api/v2/device-credentials refresh_token' => ['Retry-After' => '0'],
            'DELETE /api/v2/device-credentials/dcr_a' => ['X-RateLimit-Reset' => (string) (time() - 5)],
            'DELETE /api/v2/device-credentials/dcr_b' => [],
        ];
        $blocked = false;
        $client = self::stubClient(function (RequestInterface $request) use (&$limited, &$credentials, &$blocked): ResponseInterface {
            $method = $request->getMethod();
            $path = $request->getUri()->getPath();
            parse_str($request->getUri()->getQuery(), $query);
            $key = $method.' '.$path.($method === 'GET' ? ' '.$query['type'] : '');
            if (array_key_exists($key, $limited)) {
                $headers = $limited[$key];
                unset($limited[$key]);

                return new Response(429, ['Content-Type' => 'application/json'] + $headers, self::TOO_MANY);
            }
            if ($method === 'DELETE' && (str_ends_with($path, '/sessions') || str_ends_with($path, '/refresh-tokens'))) {
                return new Response(403, [], '{"errorCode":"feature_not_enabled"}');
            }
            if ($method === 'PATCH') {
                $blocked = true;

                return new Response(200, [], '{"blocked":true}');
            }
            if ($method === 'GET') {
                $type = (string) $query['type'];

                return new Response(200, [], (string) json_encode(array_map(static fn (string $id): array => ['id' => $id, 'type' => $type], $credentials[$type])));
            }
            $id = substr($path, strlen('/api/v2/device-credentials/'));
            $credentials['refresh_token'] = array_values(array_diff($credentials['refresh_token'], [$id]));

            return new Response(204);
        });
        $auth0 = new Auth0Provider('mgmt_token', baseUrl: 'https://tenant.example/api/v2', http: $client);

        $this->assertSame('ban', $auth0->act('revoke_sessions', 'auth0|abc'));
        $this->assertTrue($blocked);
        $this->assertSame([], $credentials['refresh_token']);
        $this->assertSame([], $limited);
        $counts = array_count_values($client->sent);
        $this->assertSame(2, $counts['GET /api/v2/device-credentials refresh_token']);
        $this->assertSame(2, $counts['DELETE /api/v2/device-credentials/dcr_a']);
        $this->assertSame(2, $counts['DELETE /api/v2/device-credentials/dcr_b']);
    }

    public function test_auth0_throws_a_429_at_once_when_the_wait_it_asks_for_passes_the_budget(): void
    {
        $client = self::stubClient(static fn (): ResponseInterface => new Response(429, ['Retry-After' => '60'], self::TOO_MANY));
        $auth0 = new Auth0Provider('mgmt_token', baseUrl: 'https://tenant.example/api/v2', http: $client);
        $started = microtime(true);
        try {
            $auth0->act('revoke_sessions', 'auth0|abc');
            $this->fail('a 429 past the budget must throw');
        } catch (ProviderActionException $e) {
            $this->assertSame(429, $e->status);
            $this->assertSame('too_many_requests', $e->errorCode);
        }
        $this->assertLessThan(1.0, microtime(true) - $started);
        $this->assertCount(1, $client->sent);
    }

    public function test_a_provider_without_act_reports_the_action_asked_for(): void
    {
        $plain = new class implements LateResultProvider {
            /** @var list<string> */
            public array $done = [];

            public function name(): string
            {
                return 'plain';
            }

            public function revokeSessions(string $userId): void
            {
                $this->done[] = "revoke {$userId}";
            }

            public function ban(string $userId): void
            {
                $this->done[] = "ban {$userId}";
            }
        };
        [$raw, $headers] = self::delivery(self::data('complete', 'review'), 'u_1');
        $this->assertSame('revoke_sessions', LateResults::handleLateResult($raw, $headers, self::secrets(), $plain, now: self::NOW)->action);
        $this->assertSame('ban', LateResults::handleLateResult($raw, $headers, self::secrets(), $plain, policy: ['review' => 'ban'], now: self::NOW)->action);
        $this->assertSame(['revoke u_1', 'ban u_1'], $plain->done);
    }

    public function test_an_unverified_quiet_or_unmapped_event_makes_no_provider_call_and_a_provider_refusal_throws(): void
    {
        $auth0 = new Auth0Provider('mgmt_token', baseUrl: $this->url.'/forbid/api/v2');
        [$raw, $headers] = self::delivery(self::data('complete', 'review'), 'auth0|abc');
        $code = static function (callable $run): string {
            try {
                $run();
            } catch (VerificationException $e) {
                return $e->errorCode;
            }

            return 'no exception';
        };
        $this->assertSame('invalid_signature', $code(fn () => LateResults::handleLateResult($raw, $headers, [self::KEY => 'wrong'], $auth0, now: self::NOW)));
        $this->assertSame('invalid_signature', $code(fn () => LateResults::handleLateResult($raw.' ', $headers, self::secrets(), $auth0, now: self::NOW)));
        $this->assertSame('invalid_timestamp', $code(fn () => LateResults::handleLateResult($raw, $headers, self::secrets(), $auth0, now: self::NOW + 301)));
        foreach ([
            self::data('complete', 'step_up'),
            self::fixture('valid/assessment-view-pending.json'),
            self::fixture('valid/assessment-view-pending-known-account.json'),
            self::fixture('valid/webhook-assessment-expired.json')->data,
        ] as $data) {
            [$r, $h] = self::delivery($data);
            $this->assertSame('none', LateResults::handleLateResult($r, $h, self::secrets(), $auth0, now: self::NOW)->action);
        }
        $this->assertSame('none', LateResults::handleLateResult($raw, $headers, self::secrets(), $auth0, userId: static fn (): ?string => null, now: self::NOW)->action);
        $this->assertSame([], $this->calls());

        try {
            LateResults::handleLateResult($raw, $headers, self::secrets(), $auth0, now: self::NOW);
            $this->fail('expected ProviderActionException');
        } catch (ProviderActionException $e) {
            $this->assertSame(403, $e->status);
            $this->assertSame('auth0', $e->provider);
            $this->assertStringNotContainsString('secret-body', $e->getMessage());
            $this->assertStringNotContainsString('mgmt_token', $e->getMessage());
        }
        $this->assertCount(1, $this->calls());
    }

    public function test_a_test_event_is_flagged_and_makes_no_provider_call_even_under_a_ban_policy_with_a_resolver(): void
    {
        $sample = self::fixture('valid/webhook-assessment-updated-test.json')->data;
        $clerk = new ClerkProvider('sk_test_mock', $this->url.'/v1');
        $banAll = ['allow' => 'ban', 'step_up' => 'ban', 'review' => 'ban', 'block' => 'ban'];
        $resolver = static fn (): string => 'user_2EXAMPLE';
        [$raw, $headers] = self::delivery($sample, null, true);
        $result = LateResults::handleLateResult($raw, $headers, self::secrets(), $clerk, policy: $banAll, userId: $resolver, now: self::NOW);
        $this->assertSame('none', $result->action);
        $this->assertTrue($result->event->test);
        $this->assertNull($result->userId);
        $this->assertSame([], $this->calls());

        // The same body without the flag would ban, and an ordinary delivery is not a test.
        [$raw, $headers] = self::delivery($sample);
        $real = LateResults::handleLateResult($raw, $headers, self::secrets(), $clerk, policy: $banAll, userId: $resolver, now: self::NOW);
        $this->assertFalse($real->event->test);
        $this->assertSame('ban', $real->action);
        $this->assertSame(['POST /v1/users/user_2EXAMPLE/ban'], self::lines($this->calls()));
    }

    public function test_a_repeated_ban_after_the_user_is_gone_completes_and_a_500_still_throws(): void
    {
        // Every user-scoped endpoint answers 404: the first delivery already removed the user.
        $providers = [
            new WorkosProvider('sk_test_workos', $this->url.'/gone'),
            new ClerkProvider('sk_test_mock', $this->url.'/gone/v1'),
            new Auth0Provider('mgmt_token', baseUrl: $this->url.'/gone/api/v2'),
        ];
        [$raw, $headers] = self::delivery(self::data('complete', 'review'), 'user_GONE');
        for ($i = 0; $i < 2; $i++) {
            foreach ($providers as $provider) {
                $this->assertSame('ban', LateResults::handleLateResult($raw, $headers, self::secrets(), $provider, policy: ['review' => 'ban'], now: self::NOW)->action);
                $this->assertSame('revoke_sessions', LateResults::handleLateResult($raw, $headers, self::secrets(), $provider, now: self::NOW)->action);
            }
        }
        $lines = self::lines($this->calls());
        foreach ([
            'GET /gone/user_management/users/user_GONE/sessions',
            'DELETE /gone/user_management/users/user_GONE',
            'GET /gone/v1/sessions',
            'POST /gone/v1/users/user_GONE/ban',
            'PATCH /gone/api/v2/users/user_GONE',
            'DELETE /gone/api/v2/users/user_GONE/refresh-tokens',
        ] as $line) {
            $this->assertContains($line, $lines);
        }

        // A session that ends between the list and its revoke also counts as done.
        $this->resetCalls();
        (new ClerkProvider('sk_test_mock', $this->url.'/vanish/v1'))->revokeSessions('user_2EXAMPLE');
        $this->assertSame(['GET /vanish/v1/sessions', 'POST /vanish/v1/sessions/sess_1/revoke'], self::lines($this->calls()));

        foreach ([
            new WorkosProvider('k', $this->url.'/broken'),
            new ClerkProvider('k', $this->url.'/broken/v1'),
            new Auth0Provider('t', baseUrl: $this->url.'/broken/api/v2'),
        ] as $provider) {
            try {
                $provider->ban('user_X');
                $this->fail('expected ProviderActionException');
            } catch (ProviderActionException $e) {
                $this->assertSame(500, $e->status);
            }
        }
    }

    public function test_empty_user_id_and_missing_credentials_are_argument_errors(): void
    {
        $clerk = new ClerkProvider('sk_test_mock', $this->url.'/v1');
        foreach ([fn () => $clerk->revokeSessions(''), fn () => $clerk->ban(''), fn () => new ClerkProvider(''), fn () => new Auth0Provider('t')] as $run) {
            try {
                $run();
                $this->fail('expected InvalidArgumentException');
            } catch (\InvalidArgumentException) {
                $this->addToAssertionCount(1);
            }
        }
        $this->assertSame([], $this->calls());
    }

    public function test_the_log_only_provider_logs_what_it_would_revoke_or_ban_and_calls_nothing(): void
    {
        $lines = [];
        $logOnly = new LogOnlyProvider(function (string $line) use (&$lines): void {
            $lines[] = $line;
        });
        $this->assertSame('log_only', $logOnly->name());
        [$raw, $headers] = self::delivery(self::data('complete', 'review'), 'usr_8f2k1');
        $revoked = LateResults::handleLateResult($raw, $headers, self::secrets(), $logOnly, now: self::NOW);
        $this->assertSame('revoke_sessions', $revoked->action);
        $this->assertSame('usr_8f2k1', $revoked->userId);
        $banned = LateResults::handleLateResult($raw, $headers, self::secrets(), $logOnly, policy: ['review' => 'ban'], now: self::NOW);
        $this->assertSame('ban', $banned->action);
        $this->assertSame([
            'NoResponse late result (log only): would revoke every session of user usr_8f2k1',
            'NoResponse late result (log only): would ban user usr_8f2k1 and end their sessions',
        ], $lines);
        [$testRaw, $testHeaders] = self::delivery(self::data('complete', 'review'), 'usr_8f2k1', true);
        $this->assertSame('none', LateResults::handleLateResult($testRaw, $testHeaders, self::secrets(), $logOnly, now: self::NOW)->action);
        $this->assertCount(2, $lines);
        try {
            $logOnly->ban('');
            $this->fail('expected InvalidArgumentException');
        } catch (\InvalidArgumentException) {
            $this->addToAssertionCount(1);
        }
        $this->assertSame([], $this->calls());
    }
}
