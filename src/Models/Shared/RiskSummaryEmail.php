<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class RiskSummaryEmail
{
    /**
     *
     * @var ?bool $disposable
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('disposable')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?bool $disposable = null;

    /**
     * Accounts found for the email.
     *
     * @var ?int $accountsFound
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('accounts_found')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $accountsFound = null;

    /**
     * Breach facts for one selector. found is the one required member: false is a definite 'in no breach table'. Every other member is optional, and absent makes no claim. No member carries a breach value, password or hash, and unknown members are refused. truncated means the value matched more tables or records than the lookup keeps, so absence-based claims (a missing name match, for example) are withheld; a truncated result is always found.
     *
     * @var ?\NoResponse\Models\Shared\BreachSummary $breach
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('breach')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\BreachSummary|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?BreachSummary $breach = null;

    /**
     * @param  ?bool  $disposable
     * @param  ?int  $accountsFound
     * @param  ?\NoResponse\Models\Shared\BreachSummary  $breach
     * @phpstan-pure
     */
    public function __construct(?bool $disposable = null, ?int $accountsFound = null, ?BreachSummary $breach = null)
    {
        $this->disposable = $disposable;
        $this->accountsFound = $accountsFound;
        $this->breach = $breach;
    }
}