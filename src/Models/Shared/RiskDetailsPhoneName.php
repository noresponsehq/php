<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class RiskDetailsPhoneName
{
    /**
     *
     * @var string $value
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('value')]
    public string $value;

    /**
     *
     * @var int $seenBy
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('seen_by')]
    public int $seenBy;

    /**
     * @param  string  $value
     * @param  int  $seenBy
     * @phpstan-pure
     */
    public function __construct(string $value, int $seenBy)
    {
        $this->value = $value;
        $this->seenBy = $seenBy;
    }
}