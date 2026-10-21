<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ProblemInvalidParam
{
    /**
     *
     * @var string $field
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('field')]
    public string $field;

    /**
     *
     * @var string $reason
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('reason')]
    public string $reason;

    /**
     *
     * @var ?string $example
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('example')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $example = null;

    /**
     * @param  string  $field
     * @param  string  $reason
     * @param  ?string  $example
     * @phpstan-pure
     */
    public function __construct(string $field, string $reason, ?string $example = null)
    {
        $this->field = $field;
        $this->reason = $reason;
        $this->example = $example;
    }
}