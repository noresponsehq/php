<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class SourceCount
{
    /**
     *
     * @var int $asked
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('asked')]
    public int $asked;

    /**
     *
     * @var int $answered
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('answered')]
    public int $answered;

    /**
     * @param  int  $asked
     * @param  int  $answered
     * @phpstan-pure
     */
    public function __construct(int $asked, int $answered)
    {
        $this->asked = $asked;
        $this->answered = $answered;
    }
}