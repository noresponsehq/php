<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AttendeeReviewRequest - Records a decision on an attendee. */
class AttendeeReviewRequest
{
    /**
     *
     * @var \NoResponse\Models\Shared\AttendeeDecision|string $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttendeeDecision|string')]
    public AttendeeDecision|string $decision;

    /**
     * Why, for the venue team and later reviewers.
     *
     * @var ?string $note
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('note')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $note = null;

    /**
     * @param  \NoResponse\Models\Shared\AttendeeDecision|string  $decision
     * @param  ?string  $note
     * @phpstan-pure
     */
    public function __construct(AttendeeDecision|string $decision, ?string $note = null)
    {
        $this->decision = $decision;
        $this->note = $note;
    }
}