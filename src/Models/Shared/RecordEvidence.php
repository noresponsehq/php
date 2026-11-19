<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RecordEvidence - One item of evidence behind a record's likelihood. */
class RecordEvidence
{
    /**
     * found_by: what found the record, which sets where its likelihood starts. agrees: a value the record shares with what the investigator gave or with a joined record. clashes: a birth date, full name, gender or country that differs from theirs.
     *
     * @var \NoResponse\Models\Shared\RecordEvidenceSignal|string $signal
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('signal')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RecordEvidenceSignal|string')]
    public RecordEvidenceSignal|string $signal;

    /**
     * The item's weight in bits, to two places: log2 of how much likelier the evidence is for the same person than for a stranger. Positive raises the likelihood and negative lowers it.
     *
     * @var float $bits
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('bits')]
    public float $bits;

    /**
     * For found_by, what the search looked up (email, phone, username, handle, name). Otherwise the kind of value compared, such as email, username, person_name, born, city or crypto_address.
     *
     * @var ?string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $kind = null;

    /**
     * The record's own field that agreed or clashed, or for found_by the field the search matched.
     *
     * @var ?string $field
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('field')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $field = null;

    /**
     * given for what the investigator gave, or the id of the person's record it agreed or clashed with, or for found_by the record whose value the search looked up.
     *
     * @var ?string $with
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('with')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $with = null;

    /**
     * The field on the other side: the field of the given identity or of the record named by with.
     *
     * @var ?string $withField
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('with_field')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $withField = null;

    /**
     * @param  \NoResponse\Models\Shared\RecordEvidenceSignal|string  $signal
     * @param  float  $bits
     * @param  ?string  $kind
     * @param  ?string  $field
     * @param  ?string  $with
     * @param  ?string  $withField
     * @phpstan-pure
     */
    public function __construct(RecordEvidenceSignal|string $signal, float $bits, ?string $kind = null, ?string $field = null, ?string $with = null, ?string $withField = null)
    {
        $this->signal = $signal;
        $this->bits = $bits;
        $this->kind = $kind;
        $this->field = $field;
        $this->with = $with;
        $this->withField = $withField;
    }
}