<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningNotAnalysedCount - How many items read were not analysed for one reason. */
class ScreeningNotAnalysedCount
{
    /**
     * Why an item read was not analysed. video: a video, whose caption alone is read. image_unavailable: the image could not be fetched from the platform. image_unsupported: not a JPEG, PNG, GIF or WebP image, or too large to send. image_limit: past the most images one attendee's analysis reads. refused: the model declined to read it. unfinished: the model cut its batch short or answered outside the schema, or the request was rejected. unverified: a finding cited it with words it does not contain or an image it did not describe. unspecified: the analyser gave no reason.
     *
     * @var \NoResponse\Models\Shared\ScreeningNotAnalysedReason|string $reason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reason')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningNotAnalysedReason|string')]
    public ScreeningNotAnalysedReason|string $reason;

    /**
     *
     * @var int $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    public int $items;

    /**
     * @param  \NoResponse\Models\Shared\ScreeningNotAnalysedReason|string  $reason
     * @param  int  $items
     * @phpstan-pure
     */
    public function __construct(ScreeningNotAnalysedReason|string $reason, int $items)
    {
        $this->reason = $reason;
        $this->items = $items;
    }
}