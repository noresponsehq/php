<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use NoResponse\Models\Errors\NotFoundException;
use NoResponse\Models\Shared;
use NoResponse\NoResponseClient;
use NoResponse\Wait;
use NoResponse\WebhookVerification\Webhook;
use NoResponse\WebhookVerification\WebhookVerificationException;
use PHPUnit\Framework\TestCase;

/**
 * Consumer smoke test of the client against a live API.
 *
 * Skipped unless NORESPONSE_LIVE_URL and NORESPONSE_LIVE_API_KEY name an API
 * and a key with the assess and history scopes (a test key keeps it off real
 * sources). It assesses a synthetic account, replays the request, reads it
 * back, waits for it to settle, lists its history and checks the typed 404.
 * NORESPONSE_LIVE_WEBHOOK_VECTORS names deliveries the same API signed, in
 * the shape of webhook-signature-vector.json, for the verifier. Each step
 * writes its name to NORESPONSE_LIVE_REPORT, and "done" at the end, so a
 * failure names the operation (integrations/regression/suites/sdks.sh).
 */
final class LiveTest extends TestCase
{
    private static function step(string $name): void
    {
        $report = getenv('NORESPONSE_LIVE_REPORT');
        if ($report !== false && $report !== '') {
            file_put_contents($report, $name);
        }
    }

    /** The string value of an open enum, which a client may hold as a case or as a string. */
    private static function value(\BackedEnum|string $value): string
    {
        return $value instanceof \BackedEnum ? (string) $value->value : $value;
    }

    /** @param  list<Shared\AssessmentDetail>  $items */
    private static function assessmentIds(array $items): array
    {
        return array_map(static fn (Shared\AssessmentDetail $item): string => $item->assessmentId, $items);
    }

    public function test_a_consumer_assesses_waits_for_and_lists_an_account(): void
    {
        $url = getenv('NORESPONSE_LIVE_URL');
        $key = getenv('NORESPONSE_LIVE_API_KEY');
        if (! $url || ! $key) {
            self::markTestSkipped('set NORESPONSE_LIVE_URL and NORESPONSE_LIVE_API_KEY to run against a live API');
        }
        $client = NoResponseClient::builder()->setSecurity($key)->setServerUrl($url)->build();
        $accountId = 'sdk-live-php-'.(getenv('NORESPONSE_LIVE_RUN') ?: bin2hex(random_bytes(4)));
        $idempotencyKey = 'sdk-live-'.bin2hex(random_bytes(16));
        $request = new Shared\AssessmentRequest(
            accountId: $accountId,
            flow: Shared\Flow::AccountCreation,
            identifiers: new Shared\AssessmentRequestIdentifiers(email: 'sdk-live@example.com'),
        );

        self::step('create');
        $created = $client->assessments->create(body: $request, idempotencyKey: $idempotencyKey)->result;
        self::assertStringStartsWith('asm_', $created->id);
        self::assertSame($accountId, $created->detail->accountId);

        self::step('replay');
        self::assertSame($created->id, $client->assessments->create(body: $request, idempotencyKey: $idempotencyKey)->result->id);

        self::step('get');
        self::assertSame($created->id, $client->assessments->get($created->id)->result->id);

        self::step('wait');
        $settled = Wait::wait($client, $created->id, 60.0);
        self::assertContains(self::value($settled->status), ['complete', 'partial']);
        self::assertNotNull($settled->account);

        self::step('query');
        $history = $client->assessments->query(new Shared\AssessmentQuery(accountId: $accountId, limit: 5))->current()->result->items;
        self::assertContains($created->id, self::assessmentIds($history));
        self::assertSame([$accountId], array_values(array_unique(array_map(static fn ($item) => $item->accountId, $history))));

        self::step('list_account_assessments');
        $page = $client->accounts->listAssessments($accountId, limit: 5)->current()->result->items;
        self::assertContains($created->id, self::assessmentIds($page));

        self::step('get_account');
        $account = $client->accounts->get($accountId)->result;
        self::assertSame($accountId, $account->id);
        self::assertSame(self::value($settled->account->risk->decision), self::value($account->risk->decision));

        self::step('not_found');
        try {
            $client->assessments->get('asm_'.str_repeat('0', 26));
            self::fail('an unknown assessment did not raise NotFoundException');
        } catch (NotFoundException $missing) {
            self::assertSame(404, $missing->getStatusCode());
            self::assertNotSame('', $missing->getRequestId());
        }

        $vectors = getenv('NORESPONSE_LIVE_WEBHOOK_VECTORS');
        foreach ($vectors ? json_decode((string) file_get_contents($vectors), true, 512, JSON_THROW_ON_ERROR) : [] as $vector) {
            self::step('verify_webhook '.$vector['type']);
            $secrets = [$vector['key_id'] => $vector['secret_utf8']];
            $now = (int) $vector['timestamp'];
            self::assertSame($vector['type'], Webhook::constructEvent($vector['payload'], $vector['headers'], $secrets, now: $now)->type);
            try {
                Webhook::constructEvent($vector['payload'].' ', $vector['headers'], $secrets, now: $now);
                self::fail('a tampered delivery verified');
            } catch (WebhookVerificationException $refused) {
                self::assertSame(WebhookVerificationException::INVALID_SIGNATURE, $refused->errorCode);
            }
        }
        self::step('done');
    }
}
