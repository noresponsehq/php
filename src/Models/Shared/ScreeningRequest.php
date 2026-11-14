<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningRequest - Screens the group's people no screening has reached and everyone on watch or escalated. */
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
     * $platforms
     *
     * @var array<\NoResponse\Models\Shared\HandlePlatform|string> $platforms
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('platforms')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\HandlePlatform|string>')]
    public array $platforms;

    /**
     * @param  \NoResponse\Models\Shared\ScreeningDepth|string  $depth
     * @param  array<\NoResponse\Models\Shared\HandlePlatform|string>  $platforms
     * @phpstan-pure
     */
    public function __construct(ScreeningDepth|string $depth, array $platforms)
    {
        $this->depth = $depth;
        $this->platforms = $platforms;
    }
}