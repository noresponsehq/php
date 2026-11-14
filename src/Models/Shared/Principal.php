<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Principal - A person the group protects. */
class Principal
{
    /**
     * The principal's name.
     *
     * @var string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    public string $name;

    /**
     * Other names the principal goes by, at most 10.
     *
     * @var ?array<string> $aliases
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('aliases')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $aliases = null;

    /**
     * @param  string  $name
     * @param  ?array<string>  $aliases
     * @phpstan-pure
     */
    public function __construct(string $name, ?array $aliases = null)
    {
        $this->name = $name;
        $this->aliases = $aliases;
    }
}