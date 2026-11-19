<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use NoResponse\Models\Shared\Group;
use NoResponse\Models\Shared\GroupUpdate;
use NoResponse\Utils\JSON;
use PHPUnit\Framework\TestCase;

final class GroupDatesTest extends TestCase
{
    public function test_dates_preserve_omission_and_null(): void
    {
        $serializer = JSON::createSerializer();
        $building = new \NoResponse\Models\Shared\GroupRequest(name: 'Harbour building');
        self::assertSame(['name' => 'Harbour building'], json_decode($serializer->serialize($building, 'json'), true));
        $body = new GroupUpdate();
        self::assertSame('{}', $serializer->serialize($body, 'json'));
        $body = new GroupUpdate(startsAt: null, endsAt: null);
        self::assertSame(['starts_at' => null, 'ends_at' => null], json_decode($serializer->serialize($body, 'json'), true));
        $body->startsAt = '2026-12-03T09:00:00Z';
        self::assertSame('2026-12-03T09:00:00Z', json_decode($serializer->serialize($body, 'json'), true)['starts_at']);
        $group = $serializer->deserialize('{"id":"grp_example","environment":"test","name":"Harbour building","starts_at":null,"ends_at":null,"principals":[],"topics":[],"people":0,"version":1,"created_by":"test","created_at":"2026-11-15T10:00:00Z","updated_at":"2026-11-15T10:00:00Z"}', Group::class, 'json');
        self::assertNull($group->startsAt);
        self::assertNull($group->endsAt);
        $other = $serializer->deserialize('{"group_id":"grp_building","group_name":"Harbour building","group_starts_at":null,"person_id":"per_example","matched_on":["person_id"],"match_state":"unscreened","decision":null}', \NoResponse\Models\Shared\OtherGroup::class, 'json');
        self::assertNull($other->groupStartsAt);
    }
}
