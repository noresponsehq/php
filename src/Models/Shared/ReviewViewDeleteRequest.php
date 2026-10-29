<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ReviewViewDeleteRequest
{
    /**
     *
     * @var int $expectedVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expected_version')]
    public int $expectedVersion;

    /**
     * @param  int  $expectedVersion
     * @phpstan-pure
     */
    public function __construct(int $expectedVersion)
    {
        $this->expectedVersion = $expectedVersion;
    }
}