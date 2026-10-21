<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** BreachSummary - Breach facts for one selector. found is the one required member: false is a definite 'in no breach table'. Every other member is optional, and absent makes no claim. No member carries a breach value, password or hash, and unknown members are refused. truncated means the value matched more tables or records than the lookup keeps, so absence-based claims (a missing name match, for example) are withheld; a truncated result is always found. */
class BreachSummary
{
    /**
     *
     * @var bool $found
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('found')]
    public bool $found;

    /**
     * Distinct breach tables the value appears in.
     *
     * @var ?int $breachCount
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('breach_count')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $breachCount = null;

    /**
     * Year of the oldest dated table.
     *
     * @var ?int $firstYear
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('first_year')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $firstYear = null;

    /**
     * Year of the newest dated table.
     *
     * @var ?int $lastYear
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('last_year')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $lastYear = null;

    /**
     * The union of data kinds the matching tables held, without the values.
     *
     * @var ?array<\NoResponse\Models\Shared\BreachExposed> $exposed
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('exposed')]
    #[\Speakeasy\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\BreachExposed>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $exposed = null;

    /**
     * The value is in a credential_list or stealer_log table.
     *
     * @var ?bool $inCredentialLists
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('in_credential_lists')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?bool $inCredentialLists = null;

    /**
     * A plaintext password sat next to the value in a table dated two years ago or less, or the value is in a stealer_log table.
     *
     * @var ?bool $recentPasswordExposure
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('recent_password_exposure')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?bool $recentPasswordExposure = null;

    /**
     *
     * @var ?bool $truncated
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('truncated')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?bool $truncated = null;

    /**
     * @param  bool  $found
     * @param  ?int  $breachCount
     * @param  ?int  $firstYear
     * @param  ?int  $lastYear
     * @param  ?array<\NoResponse\Models\Shared\BreachExposed>  $exposed
     * @param  ?bool  $inCredentialLists
     * @param  ?bool  $recentPasswordExposure
     * @param  ?bool  $truncated
     * @phpstan-pure
     */
    public function __construct(bool $found, ?int $breachCount = null, ?int $firstYear = null, ?int $lastYear = null, ?array $exposed = null, ?bool $inCredentialLists = null, ?bool $recentPasswordExposure = null, ?bool $truncated = null)
    {
        $this->found = $found;
        $this->breachCount = $breachCount;
        $this->firstYear = $firstYear;
        $this->lastYear = $lastYear;
        $this->exposed = $exposed;
        $this->inCredentialLists = $inCredentialLists;
        $this->recentPasswordExposure = $recentPasswordExposure;
        $this->truncated = $truncated;
    }
}