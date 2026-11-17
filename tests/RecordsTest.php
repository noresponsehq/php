<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use NoResponse\Models\Shared;
use NoResponse\NoResponseClient;
use PHPUnit\Framework\TestCase;

/** A person's report returns the contract's worked records as typed models. */
final class RecordsTest extends TestCase
{
    /** @param list<Shared\RecordField> $fields */
    private static function field(array $fields, string $name): Shared\RecordField
    {
        foreach ($fields as $field) {
            if ($field->field === $name) {
                return $field;
            }
        }
        self::fail("no field $name");
    }

    public function test_a_persons_report_returns_typed_records(): void
    {
        $body = (string) file_get_contents(__DIR__.'/fixtures/valid/person-report-records.json');
        $person = json_decode($body, true, flags: JSON_THROW_ON_ERROR)['person'];

        $history = [];
        $stack = HandlerStack::create(fn ($request) => \GuzzleHttp\Promise\Create::promiseFor(new Response(200, ['Content-Type' => 'application/json'], $body)));
        $stack->push(Middleware::history($history));
        $client = NoResponseClient::builder()->setClient(new Client(['handler' => $stack, 'http_errors' => false]))
            ->setSecurity('nrk_test_records_fixture')->setServerUrl('https://api.example.test')->build();
        $report = $client->groups->getPerson($person['group_id'], $person['id'])->result;
        self::assertSame("/v1/groups/{$person['group_id']}/people/{$person['id']}", $history[0]['request']->getUri()->getPath());

        [$account, $row] = $report->lookup->records;
        self::assertInstanceOf(Shared\Record::class, $account);
        self::assertSame('platform', $account->source->kind);
        self::assertSame('github.com', $account->source->site);
        $login = self::field($account->fields, 'login');
        self::assertSame(Shared\RecordKind::Username, $login->kind);
        self::assertSame(Shared\RecordRole::Handle, $login->role);
        self::assertSame('jordan-ellis', $login->value);
        self::assertSame(Shared\Rating::Distinctive, $login->distinctive->rating);
        self::assertSame('Jordan Ellis', self::field($account->fields, 'name')->value);
        self::assertNull(self::field($account->fields, 'hireable')->role);
        self::assertSame(0.74, $account->likelihood);
        self::assertSame(['name', 'twitter_username'], $account->agreed);
        self::assertTrue($account->joined);
        self::assertSame(Shared\Verdict::Joined, $account->verdict);

        self::assertSame('site_breach', $row->source->kind);
        self::assertSame('FORUM_EXAMPLE_NET_2019', $row->source->table);
        self::assertSame('2019-03', $row->source->date);
        $password = self::field($row->fields, 'password');
        self::assertSame(Shared\RecordKind::Password, $password->kind);
        self::assertSame('Leeds1990!', $password->value);
        self::assertSame('bcrypt', self::field($row->fields, 'password_hash')->detail);
        $lastIp = self::field($row->fields, 'lastip');
        self::assertSame(Shared\RecordRole::LastIp, $lastIp->role);
        self::assertSame('203.0.113.5', $lastIp->value);
        $birthday = self::field($row->fields, 'birthday');
        self::assertNull($birthday->value);
        self::assertSame('07/03/1990', $birthday->original);
        self::assertSame(0.8, $row->likelihood);
        self::assertNull($row->verdict);

        $remaining = $report->lookup->remaining[0];
        self::assertSame('credential_list', $remaining->source->kind);
        self::assertSame('username', $remaining->by);
        self::assertSame(37, $remaining->rows);
    }
}
