<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningRequest - Screens the group's people no screening has reached. */
class ScreeningRequest
{
    /**
     *
     * @var \NoResponse\Models\Shared\ScreeningDepth|string $depth
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('depth')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningDepth|string')]
    public ScreeningDepth|string $depth;

    /**
     * @param  \NoResponse\Models\Shared\ScreeningDepth|string  $depth
     * @phpstan-pure
     */
    public function __construct(ScreeningDepth|string $depth)
    {
        $this->depth = $depth;
    }
}