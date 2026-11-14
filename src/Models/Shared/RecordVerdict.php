<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RecordVerdict - A recorded verdict on one record. A later verdict on the same record replaces it. */
class RecordVerdict
{
    /**
     *
     * @var string $recordId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('record_id')]
    public string $recordId;

    /**
     * A reviewer's overrule (POST .../people/{person_id}/records), which decides joined whatever the likelihood and sticks for as long as a lookup finds the same record. Absent when nobody overruled it.
     *
     * @var \NoResponse\Models\Shared\Verdict|string $verdict
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('verdict')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Verdict|string')]
    public Verdict|string $verdict;

    /**
     *
     * @var string $decidedBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decided_by')]
    public string $decidedBy;

    /**
     *
     * @var string $decidedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decided_at')]
    public string $decidedAt;

    /**
     * @param  string  $recordId
     * @param  \NoResponse\Models\Shared\Verdict|string  $verdict
     * @param  string  $decidedBy
     * @param  string  $decidedAt
     * @phpstan-pure
     */
    public function __construct(string $recordId, Verdict|string $verdict, string $decidedBy, string $decidedAt)
    {
        $this->recordId = $recordId;
        $this->verdict = $verdict;
        $this->decidedBy = $decidedBy;
        $this->decidedAt = $decidedAt;
    }
}