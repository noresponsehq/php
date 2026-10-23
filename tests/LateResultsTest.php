<?php

declare(strict_types=1);

namespace NoResponse\Tests;

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
            $data = clone $data;
            $data->account_id = $accountId;
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

    private static function data(string $status, ?string $recommendation): \stdClass
    {
        $data = self::fixture('valid/assessment-complete.json');
        $data->status = $status;
        $data->recommendation = $recommendation;
        if (isset($data->risk)) {
            $data->risk->recommendation = $recommendation;
        }

        return $data;
    }

    public function test_default_policy_revokes_on_review_and_does_nothing_on_allow_step_up_pending_or_expiry(): void
    {
        $review = self::event(self::fixture('valid/assessment-phone-uncovered-complete.json'));
        $stepUp = self::event(self::fixture('valid/assessment-complete.json'));
        $pending = self::event(self::fixture('valid/assessment-pending.json'));
        $expired = self::event(self::fixture('valid/webhook-assessment-expired.json')->data);
        $this->assertInstanceOf(AssessmentExpired::class, $expired->data);

        $this->assertSame('revoke_sessions', LateResults::lateResultAction($review));
        $this->assertSame('none', LateResults::lateResultAction($stepUp));
        $this->assertSame('none', LateResults::lateResultAction($pending));
        $this->assertSame('none', LateResults::lateResultAction($expired));
        $this->assertSame('none', LateResults::lateResultAction(self::event(self::data('partial', 'allow'))));
        $this->assertSame('none', LateResults::lateResultAction(new Event('evt_x', 'endpoint.verification', 'x', new \NoResponse\Webhooks\EndpointVerification('whe_x', 'y'))));
        $this->assertSame('ban', LateResults::lateResultAction($stepUp, ['step_up' => 'ban']));
        $this->assertSame('none', LateResults::lateResultAction($review, ['step_up' => 'ban']));
        try {
            LateResults::lateResultAction($review, ['review' => 'delete']);
            $this->fail('expected InvalidArgumentException');
        } catch (\InvalidArgumentException) {
            $this->addToAssertionCount(1);
        }
        $this->assertSame(['allow' => 'none', 'step_up' => 'none', 'review' => 'revoke_sessions'], LateResults::DEFAULT_POLICY);
        $this->assertSame(['none', 'revoke_sessions', 'ban'], LateResultAction::ALL);
    }

    public function test_clerk_review_revokes_each_active_session_and_a_ban_policy_bans_the_user(): void
    {
        $clerk = new ClerkProvider('sk_test_mock', $this->url.'/v1');
        [$raw, $headers] = self::delivery(self::fixture('valid/assessment-phone-uncovered-complete.json'), 'user_2EXAMPLE');
        $result = LateResults::handleLateResult($raw, $headers, self::secrets(), $clerk, now: self::NOW);
        $this->assertSame('revoke_sessions', $result->action);
        $this->assertSame('user_2EXAMPLE', $result->userId);
        $this->assertSame(self::fixture('valid/assessment-phone-uncovered-complete.json')->assessment_id, $result->event->data->assessmentId);
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
        [$raw, $headers] = self::delivery(self::fixture('valid/assessment-complete.json'), 'acct_7f3a9c');
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
        [$raw, $headers] = self::delivery(self::fixture('valid/assessment-phone-uncovered-complete.json'), $id);
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

    public function test_an_unverified_quiet_or_unmapped_event_makes_no_provider_call_and_a_provider_refusal_throws(): void
    {
        $auth0 = new Auth0Provider('mgmt_token', baseUrl: $this->url.'/forbid/api/v2');
        [$raw, $headers] = self::delivery(self::fixture('valid/assessment-phone-uncovered-complete.json'), 'auth0|abc');
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
            self::fixture('valid/assessment-complete.json'),
            self::fixture('valid/assessment-pending.json'),
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
        $banAll = ['allow' => 'ban', 'step_up' => 'ban', 'review' => 'ban'];
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
        [$raw, $headers] = self::delivery(self::fixture('valid/assessment-phone-uncovered-complete.json'), 'user_GONE');
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
        [$raw, $headers] = self::delivery(self::fixture('valid/assessment-phone-uncovered-complete.json'), 'usr_8f2k1');
        $revoked = LateResults::handleLateResult($raw, $headers, self::secrets(), $logOnly, now: self::NOW);
        $this->assertSame('revoke_sessions', $revoked->action);
        $this->assertSame('usr_8f2k1', $revoked->userId);
        $banned = LateResults::handleLateResult($raw, $headers, self::secrets(), $logOnly, policy: ['review' => 'ban'], now: self::NOW);
        $this->assertSame('ban', $banned->action);
        $this->assertSame([
            'NoResponse late result (log only): would revoke every session of user usr_8f2k1',
            'NoResponse late result (log only): would ban user usr_8f2k1 and end their sessions',
        ], $lines);
        [$testRaw, $testHeaders] = self::delivery(self::fixture('valid/assessment-phone-uncovered-complete.json'), 'usr_8f2k1', true);
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
