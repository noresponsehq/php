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
     * The platforms to search. Leave it out for a full search: every platform a connector serves in the environment when the screening starts, which the screening then lists.
     *
     * @var ?array<string> $platforms
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('platforms')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $platforms = null;

    /**
     * @param  \NoResponse\Models\Shared\ScreeningDepth|string  $depth
     * @param  ?array<string>  $platforms
     * @phpstan-pure
     */
    public function __construct(ScreeningDepth|string $depth, ?array $platforms = null)
    {
        $this->depth = $depth;
        $this->platforms = $platforms;
    }
}