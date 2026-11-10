<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningMediaObservation - What an analyser saw in one image that a finding rests on. */
class ScreeningMediaObservation
{
    /**
     * The image, one of the finding's evidence.
     *
     * @var string $mediaId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('media_id')]
    public string $mediaId;

    /**
     * What the analyser saw in the image that supports the finding.
     *
     * @var string $description
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('description')]
    public string $description;

    /**
     * Words the analyser read in the image, as it read them. They come from the image's pixels, not from a post's text, so they are not a quote and were not checked against the record.
     *
     * @var ?string $readText
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('read_text')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $readText = null;

    /**
     * @param  string  $mediaId
     * @param  string  $description
     * @param  ?string  $readText
     * @phpstan-pure
     */
    public function __construct(string $mediaId, string $description, ?string $readText = null)
    {
        $this->mediaId = $mediaId;
        $this->description = $description;
        $this->readText = $readText;
    }
}