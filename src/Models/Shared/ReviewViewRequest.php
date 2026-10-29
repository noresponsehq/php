<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ReviewViewRequest
{
    /**
     *
     * @var string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    public string $name;

    /**
     *
     * @var bool $shared
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('shared')]
    public bool $shared;

    /**
     *
     * @var \NoResponse\Models\Shared\Filter $filter
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('filter')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Filter')]
    public Filter $filter;

    /**
     *
     * @var ?int $expectedVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expected_version')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $expectedVersion = null;

    /**
     * @param  string  $name
     * @param  bool  $shared
     * @param  \NoResponse\Models\Shared\Filter  $filter
     * @param  ?int  $expectedVersion
     * @phpstan-pure
     */
    public function __construct(string $name, bool $shared, Filter $filter, ?int $expectedVersion = null)
    {
        $this->name = $name;
        $this->shared = $shared;
        $this->filter = $filter;
        $this->expectedVersion = $expectedVersion;
    }
}