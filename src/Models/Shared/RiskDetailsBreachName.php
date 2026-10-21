<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class RiskDetailsBreachName
{
    /**
     *
     * @var string $value
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('value')]
    public string $value;

    /**
     *
     * @var int $seenIn
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('seen_in')]
    public int $seenIn;

    /**
     * @param  string  $value
     * @param  int  $seenIn
     * @phpstan-pure
     */
    public function __construct(string $value, int $seenIn)
    {
        $this->value = $value;
        $this->seenIn = $seenIn;
    }
}