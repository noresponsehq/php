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
     * @param  int  $index
     * @param  string  $id
     * @param  \NoResponse\Models\Shared\PersonBatchItemOutcome|string  $outcome
     * @phpstan-pure
     */
    public function __construct(int $index, string $id, PersonBatchItemOutcome|string $outcome)
    {
        $this->index = $index;
        $this->id = $id;
        $this->outcome = $outcome;
    }
}