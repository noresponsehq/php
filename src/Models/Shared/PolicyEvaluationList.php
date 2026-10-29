<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PolicyEvaluationList - Retained jobs, newest first. Follow next_before for another page. */
class PolicyEvaluationList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\PolicyEvaluation> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\PolicyEvaluation>')]
    public array $items;

    /**
     *
     * @var ?string $nextBefore
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_before')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $nextBefore = null;

    /**
     * @param  array<\NoResponse\Models\Shared\PolicyEvaluation>  $items
     * @param  ?string  $nextBefore
     * @phpstan-pure
     */
    public function __construct(array $items, ?string $nextBefore = null)
    {
        $this->items = $items;
        $this->nextBefore = $nextBefore;
    }
}