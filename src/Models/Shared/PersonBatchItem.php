<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PersonBatchItem
{
    /**
     * The row's position in the request.
     *
     * @var int $index
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('index')]
    public int $index;

    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * unchanged: the row matched a person with the same details.
     *
     * @var \NoResponse\Models\Shared\PersonBatchItemOutcome|string $outcome
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('outcome')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PersonBatchItemOutcome|string')]
    public PersonBatchItemOutcome|string $outcome;

    /**
     * $suggestedMatches
     *
     * @var ?array<\NoResponse\Models\Shared\PersonMatch> $suggestedMatches
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('suggested_matches')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\PersonMatch>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $suggestedMatches = null;

    /**
     * @param  int  $index
     * @param  string  $id
     * @param  \NoResponse\Models\Shared\PersonBatchItemOutcome|string  $outcome
     * @param  ?array<\NoResponse\Models\Shared\PersonMatch>  $suggestedMatches
     * @phpstan-pure
     */
    public function __construct(int $index, string $id, PersonBatchItemOutcome|string $outcome, ?array $suggestedMatches = null)
    {
        $this->index = $index;
        $this->id = $id;
        $this->outcome = $outcome;
        $this->suggestedMatches = $suggestedMatches;
    }
}