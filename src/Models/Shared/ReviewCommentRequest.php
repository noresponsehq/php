<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ReviewCommentRequest
{
    /**
     *
     * @var int $expectedVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expected_version')]
    public int $expectedVersion;

    /**
     *
     * @var string $body
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('body')]
    public string $body;

    /**
     * @param  int  $expectedVersion
     * @param  string  $body
     * @phpstan-pure
     */
    public function __construct(int $expectedVersion, string $body)
    {
        $this->expectedVersion = $expectedVersion;
        $this->body = $body;
    }
}