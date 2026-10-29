<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ReviewSubjectList - Retained tenant-local subject links and the current review version. */
class ReviewSubjectList
{
    /**
     *
     * @var int $reviewVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('review_version')]
    public int $reviewVersion;

    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\ReviewSubject> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ReviewSubject>')]
    public array $items;

    /**
     * @param  int  $reviewVersion
     * @param  array<\NoResponse\Models\Shared\ReviewSubject>  $items
     * @phpstan-pure
     */
    public function __construct(int $reviewVersion, array $items)
    {
        $this->reviewVersion = $reviewVersion;
        $this->items = $items;
    }
}