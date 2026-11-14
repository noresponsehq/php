<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RecordVerdictRequest - A reviewer's verdict on whether one of a person's lookup records is theirs. */
class RecordVerdictRequest
{
    /**
     * One of the person's lookup records.
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
     * @param  string  $recordId
     * @param  \NoResponse\Models\Shared\Verdict|string  $verdict
     * @phpstan-pure
     */
    public function __construct(string $recordId, Verdict|string $verdict)
    {
        $this->recordId = $recordId;
        $this->verdict = $verdict;
    }
}