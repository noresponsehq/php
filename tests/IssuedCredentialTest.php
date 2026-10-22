<?php

declare(strict_types=1);

namespace NoResponse\Tests;

use InvalidArgumentException;
use NoResponse\IssuedCredential;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class IssuedCredentialTest extends TestCase
{
    /** @return array<string, array{0: string, 1: string}> */
    public static function vectors(): array
    {
        $file = json_decode((string) file_get_contents(__DIR__.'/fixtures/issued-credential-vectors.json'), true, 512, JSON_THROW_ON_ERROR);
        $cases = [];
        foreach ($file['cases'] as $case) {
            $cases[$case['sha256']] = [$case['key'], $case['sha256']];
        }
        self::assertNotEmpty($cases);

        return $cases;
    }

    #[DataProvider('vectors')]
    public function testMatchesTheSharedVectors(string $key, string $sha256): void
    {
        $this->assertSame($sha256, IssuedCredential::sha256($key));
    }

    public function testRefusesAnEmptyKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        IssuedCredential::sha256('');
    }
}
