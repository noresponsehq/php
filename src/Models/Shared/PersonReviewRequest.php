<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PersonReviewRequest - Records a decision on a person. */
class PersonReviewRequest
{
    /**
     *
     * @var \NoResponse\Models\Shared\PersonDecision|string $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PersonDecision|string')]
    public PersonDecision|string $decision;

    /**
     * Why, for the venue team and later reviewers.
     *
     * @var ?string $note
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('note')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $note = null;

    /**
     * @param  \NoResponse\Models\Shared\PersonDecision|string  $decision
     * @param  ?string  $note
     * @phpstan-pure
     */
    public function __construct(PersonDecision|string $decision, ?string $note = null)
    {
        $this->decision = $decision;
        $this->note = $note;
    }
}