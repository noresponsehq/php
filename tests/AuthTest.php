<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use InvalidArgumentException;
use NoResponse\Auth;
use NoResponse\Utils\JSON;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class AuthTest extends TestCase
{
    /** @return array<string, mixed> */
    private static function fixture(string $name): array
    {
        return json_decode((string) file_get_contents(__DIR__.'/fixtures/'.$name), true, 512, JSON_THROW_ON_ERROR);
    }

    /** @return array<string, array{0: array<string, mixed>}> */
    public static function vectors(): array
    {
        $cases = [];
        foreach (self::fixture('auth-context-vectors.json')['cases'] as $vector) {
            $cases[$vector['name']] = [$vector];
        }
        self::assertNotEmpty($cases);

        return $cases;
    }

    /** @param array<mixed> $value */
    private static function dropNulls(array $value): array
    {
        $out = [];
        foreach ($value as $key => $item) {
            if ($item === null) {
                continue;
            }
            $out[$key] = is_array($item) ? self::dropNulls($item) : $item;
        }

        return $out;
    }

    /** @param array<string, mixed> $vector */
    private static function mapVector(array $vector): object
    {
        $claims = $vector['claims'];
        $overrides = $vector['overrides'];

        return match ($vector['provider']) {
            'workos' => Auth::fromWorkOS($claims, $overrides),
            'clerk' => Auth::fromClerk($claims, $overrides),
            'auth0' => Auth::fromAuth0($claims, $overrides),
            'supabase' => Auth::fromSupabase($claims, $overrides),
            'firebase' => Auth::fromFirebase($claims, $overrides),
            'cognito' => Auth::fromCognito($claims, $overrides),
            'entra' => Auth::fromEntra($claims, $overrides),
            'keycloak' => Auth::fromKeycloak($claims, $overrides),
            'ory' => Auth::fromOry($claims, $overrides),
            'ory_oauth2' => Auth::fromOryOAuth2($claims, $overrides),
            default => Auth::fromOIDC($vector['provider'], $claims, $overrides),
        };
    }

    /** @param  array<string, mixed>  $vector */
    #[DataProvider('vectors')]
    public function test_vector(array $vector): void
    {
        if (isset($vector['error'])) {
            $this->expectException(InvalidArgumentException::class);
            self::mapVector($vector);

            return;
        }
        $got = json_decode(JSON::createSerializer()->serialize(self::mapVector($vector), 'json'), true, 512, JSON_THROW_ON_ERROR);
        $this->assertEquals($vector['expect'], self::dropNulls($got));
    }

    public function test_embedded_claim_map_is_the_contract_map(): void
    {
        $table = self::fixture('auth-context-claim-map.json');
        unset($table['description'], $table['rules']);
        foreach ($table['providers'] as $name => $provider) {
            unset($table['providers'][$name]['notes']);
        }
        $this->assertEquals($table, Auth::claimMap());
    }
}
