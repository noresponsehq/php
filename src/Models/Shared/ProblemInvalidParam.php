<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ProblemInvalidParam
{
    /**
     *
     * @var string $field
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('field')]
    public string $field;

    /**
     *
     * @var string $reason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reason')]
    public string $reason;

    /**
     *
     * @var ?string $example
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('example')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
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