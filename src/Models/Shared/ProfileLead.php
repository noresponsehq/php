<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ProfileLead
{
    /**
     * A value copied exactly from a linked record that the person was not searched by.
     *
     * @var string $value
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('value')]
    public string $value;

    /**
     *
     * @var string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    public string $kind;

    /**
     *
     * @var string $why
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('why')]
    public string $why;

    /**
     * $evidence
     *
     * @var array<\NoResponse\Models\Shared\ProfileCitation> $evidence
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evidence')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ProfileCitation>')]
    public array $evidence;

    /**
     * @param  string  $value
     * @param  string  $kind
     * @param  string  $why
     * @param  array<\NoResponse\Models\Shared\ProfileCitation>  $evidence
     * @phpstan-pure
     */
    public function __construct(string $value, string $kind, string $why, array $evidence)
    {
        $this->value = $value;
        $this->kind = $kind;
        $this->why = $why;
        $this->evidence = $evidence;
    }
}