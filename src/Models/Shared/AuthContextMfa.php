<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AuthContextMfa - Normalized multi-factor evidence from a verified provider session. */
class AuthContextMfa
{
    /**
     *
     * @var ?bool $present
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('present')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?bool $present = null;

    /**
     * $methods
     *
     * @var ?array<string> $methods
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('methods')]
    #[\Speakeasy\Serializer\Annotation\Type('array<string>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $methods = null;

    /**
     *
     * @var ?int $ageSeconds
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('age_seconds')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $ageSeconds = null;

    /**
     * @param  ?bool  $present
     * @param  ?array<string>  $methods
     * @param  ?int  $ageSeconds
     * @phpstan-pure
     */
    public function __construct(?bool $present = null, ?array $methods = null, ?int $ageSeconds = null)
    {
        $this->present = $present;
        $this->methods = $methods;
        $this->ageSeconds = $ageSeconds;
    }
}