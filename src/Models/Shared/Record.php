<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Record - One answer from one source: where it came from, what found it and every field it holds. */
class Record
{
    /**
     * Made from the source and the fields' names and original values, so the same answer found twice is one record with the same id.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * Where a record came from.
     *
     * @var \NoResponse\Models\Shared\RecordSource $source
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('source')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RecordSource')]
    public RecordSource $source;

    /**
     * Each kind of searched value that found the record.
     *
     * @var array<\NoResponse\Models\Shared\RecordMatch> $matched
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('matched')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\RecordMatch>')]
    public array $matched;

    /**
     * Every field the source returned, in the order the source's connector lists them; a breach row's columns in name order. Nothing is withheld: a breach row's passwords, hashes and salts are fields like any other.
     *
     * @var array<\NoResponse\Models\Shared\RecordField> $fields
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('fields')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\RecordField>')]
    public array $fields;

    /**
     * When the source last gave this answer.
     *
     * @var string $observedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('observed_at')]
    public string $observedAt;

    /**
     * @param  string  $id
     * @param  \NoResponse\Models\Shared\RecordSource  $source
     * @param  array<\NoResponse\Models\Shared\RecordMatch>  $matched
     * @param  array<\NoResponse\Models\Shared\RecordField>  $fields
     * @param  string  $observedAt
     * @phpstan-pure
     */
    public function __construct(string $id, RecordSource $source, array $matched, array $fields, string $observedAt)
    {
        $this->id = $id;
        $this->source = $source;
        $this->matched = $matched;
        $this->fields = $fields;
        $this->observedAt = $observedAt;
    }
}