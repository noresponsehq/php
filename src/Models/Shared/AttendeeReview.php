<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AttendeeReview - One recorded decision. */
class AttendeeReview
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var \NoResponse\Models\Shared\AttendeeDecision|string $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttendeeDecision|string')]
    public AttendeeDecision|string $decision;

    /**
     *
     * @var string $createdBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_by')]
    public string $createdBy;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var ?string $note
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('note')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $note = null;

    /**
     * @param  string  $id
     * @param  \NoResponse\Models\Shared\AttendeeDecision|string  $decision
     * @param  string  $createdBy
     * @param  string  $createdAt
     * @param  ?string  $note
     * @phpstan-pure
     */
    public function __construct(string $id, AttendeeDecision|string $decision, string $createdBy, string $createdAt, ?string $note = null)
    {
        $this->id = $id;
        $this->decision = $decision;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
        $this->note = $note;
    }
}