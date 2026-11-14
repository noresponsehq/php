<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PersonDecided - A reviewer recorded a decision on a person. The decision's note stays in the API. Sent once per recorded review; a person's latest review is its decision, so order by decided_at. */
class PersonDecided
{
    /**
     * The person's group.
     *
     * @var string $groupId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('group_id')]
    public string $groupId;

    /**
     * The person decided on.
     *
     * @var string $personId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('person_id')]
    public string $personId;

    /**
     * The recorded review.
     *
     * @var string $reviewId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('review_id')]
    public string $reviewId;

    /**
     *
     * @var \NoResponse\Models\Shared\PersonDecision|string $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PersonDecision|string')]
    public PersonDecision|string $decision;

    /**
     * Who decided: the member's external user id, or the API key's label, as the person's decided_by.
     *
     * @var string $decidedBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decided_by')]
    public string $decidedBy;

    /**
     * When the decision was recorded; equal to the event's created_at.
     *
     * @var string $decidedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decided_at')]
    public string $decidedAt;

    /**
     * @param  string  $groupId
     * @param  string  $personId
     * @param  string  $reviewId
     * @param  \NoResponse\Models\Shared\PersonDecision|string  $decision
     * @param  string  $decidedBy
     * @param  string  $decidedAt
     * @phpstan-pure
     */
    public function __construct(string $groupId, string $personId, string $reviewId, PersonDecision|string $decision, string $decidedBy, string $decidedAt)
    {
        $this->groupId = $groupId;
        $this->personId = $personId;
        $this->reviewId = $reviewId;
        $this->decision = $decision;
        $this->decidedBy = $decidedBy;
        $this->decidedAt = $decidedAt;
    }
}