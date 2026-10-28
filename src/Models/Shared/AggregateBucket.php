<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class AggregateBucket
{
    /**
     *
     * @var string $start
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('start')]
    public string $start;

    /**
     * Assessments first answered whose creation falls in the bucket. With metric count.
     *
     * @var ?int $count
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('count')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $count = null;

    /**
     * With metric count and group_by: the bucket's counts of the groups answered, largest group first.
     *
     * @var ?array<\NoResponse\Models\Shared\AggregateGroup> $groups
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('groups')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AggregateGroup>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $groups = null;

    /**
     * $scoreHistogram
     *
     * @var ?array<\NoResponse\Models\Shared\AggregateScoreCount> $scoreHistogram
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('score_histogram')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AggregateScoreCount>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $scoreHistogram = null;

    /**
     * $lateFlips
     *
     * @var ?array<\NoResponse\Models\Shared\AggregateLateFlip> $lateFlips
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('late_flips')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AggregateLateFlip>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $lateFlips = null;

    /**
     * @param  string  $start
     * @param  ?int  $count
     * @param  ?array<\NoResponse\Models\Shared\AggregateGroup>  $groups
     * @param  ?array<\NoResponse\Models\Shared\AggregateScoreCount>  $scoreHistogram
     * @param  ?array<\NoResponse\Models\Shared\AggregateLateFlip>  $lateFlips
     * @phpstan-pure
     */
    public function __construct(string $start, ?int $count = null, ?array $groups = null, ?array $scoreHistogram = null, ?array $lateFlips = null)
    {
        $this->start = $start;
        $this->count = $count;
        $this->groups = $groups;
        $this->scoreHistogram = $scoreHistogram;
        $this->lateFlips = $lateFlips;
    }
}