<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class StageTime
{
    /**
     * ai_typing and analysis appear only on searches recorded before the engine stopped analysing results.
     *
     * @var \NoResponse\Models\Shared\Stage|string $stage
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('stage')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Stage|string')]
    public Stage|string $stage;

    /**
     *
     * @var int $ms
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('ms')]
    public int $ms;

    /**
     * @param  \NoResponse\Models\Shared\Stage|string  $stage
     * @param  int  $ms
     * @phpstan-pure
     */
    public function __construct(Stage|string $stage, int $ms)
    {
        $this->stage = $stage;
        $this->ms = $ms;
    }
}