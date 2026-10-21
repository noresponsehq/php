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
    #[\NoResponse\Serializer\Annotation\SerializedName('present')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $present = null;

    /**
     * $methods
     *
     * @var ?array<string> $methods
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('methods')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $methods = null;

    /**
     *
     * @var ?int $ageSeconds
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('age_seconds')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
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