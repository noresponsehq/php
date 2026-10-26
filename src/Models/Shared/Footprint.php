<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Footprint - How long and how widely the signup's email and username have existed, and how far independent sources agree on the person behind them, in years and counts only. families are the kinds of evidence that found either identifier. Omitted when nothing found them: a footprint lookup that failed makes no claim, and absence is no_digital_footprint's to state. */
class Footprint
{
    /**
     * $families
     *
     * @var array<\NoResponse\Models\Shared\FootprintFamily|string> $families
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('families')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\FootprintFamily|string>')]
    public array $families;

    /**
     * One identifier's dated footprint across every source: the first and last year any event was seen, the years between them, the latest year a source dated activity (omitted when none did), how many distinct sites and which kinds of evidence saw it.
     *
     * @var ?\NoResponse\Models\Shared\FootprintTimeline $email
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('email')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FootprintTimeline|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?FootprintTimeline $email = null;

    /**
     * One identifier's dated footprint across every source: the first and last year any event was seen, the years between them, the latest year a source dated activity (omitted when none did), how many distinct sites and which kinds of evidence saw it.
     *
     * @var ?\NoResponse\Models\Shared\FootprintTimeline $username
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('username')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FootprintTimeline|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?FootprintTimeline $username = null;

    /**
     *
     * @var ?\NoResponse\Models\Shared\FootprintCoherence $coherence
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('coherence')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FootprintCoherence|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?FootprintCoherence $coherence = null;

    /**
     * @param  array<\NoResponse\Models\Shared\FootprintFamily|string>  $families
     * @param  ?\NoResponse\Models\Shared\FootprintTimeline  $email
     * @param  ?\NoResponse\Models\Shared\FootprintTimeline  $username
     * @param  ?\NoResponse\Models\Shared\FootprintCoherence  $coherence
     * @phpstan-pure
     */
    public function __construct(array $families, ?FootprintTimeline $email = null, ?FootprintTimeline $username = null, ?FootprintCoherence $coherence = null)
    {
        $this->families = $families;
        $this->email = $email;
        $this->username = $username;
        $this->coherence = $coherence;
    }
}