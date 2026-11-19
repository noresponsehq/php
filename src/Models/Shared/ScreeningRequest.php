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
     * Deprecated: leave it out. Without it the screening is a full search: every platform a connector serves in the environment when the screening starts, which the screening then lists, each searched only with the identifiers its connector takes. A list sent here still limits the screening until a later contract release removes the field.
     *
     * @var ?array<string> $platforms
     * @deprecated  field: This will be removed in a future release, please migrate away from it as soon as possible.
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