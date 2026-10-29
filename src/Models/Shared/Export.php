<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Export - Retained review snapshot. */
class Export
{
    /**
     *
     * @var string $exportedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('exported_at')]
    public string $exportedAt;

    /**
     *
     * @var \NoResponse\Models\Shared\Review $review
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('review')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Review')]
    public Review $review;

    /**
     * $comments
     *
     * @var array<\NoResponse\Models\Shared\ReviewComment> $comments
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('comments')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ReviewComment>')]
    public array $comments;

    /**
     * $resolutions
     *
     * @var array<\NoResponse\Models\Shared\Resolution> $resolutions
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('resolutions')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Resolution>')]
    public array $resolutions;

    /**
     * $subjects
     *
     * @var array<\NoResponse\Models\Shared\ReviewSubject> $subjects
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('subjects')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ReviewSubject>')]
    public array $subjects;

    /**
     * @param  string  $exportedAt
     * @param  \NoResponse\Models\Shared\Review  $review
     * @param  array<\NoResponse\Models\Shared\ReviewComment>  $comments
     * @param  array<\NoResponse\Models\Shared\Resolution>  $resolutions
     * @param  array<\NoResponse\Models\Shared\ReviewSubject>  $subjects
     * @phpstan-pure
     */
    public function __construct(string $exportedAt, Review $review, array $comments, array $resolutions, array $subjects)
    {
        $this->exportedAt = $exportedAt;
        $this->review = $review;
        $this->comments = $comments;
        $this->resolutions = $resolutions;
        $this->subjects = $subjects;
    }
}