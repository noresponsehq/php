<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RecordConflict - Two identifiers you gave that lead to records of different people. */
class RecordConflict
{
    /**
     * anchors_disagree: records found by two of the identifiers you gave clash with each other, so those identifiers may belong to different people.
     *
     * @var \NoResponse\Models\Shared\RecordConflictSignal|string $signal
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('signal')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RecordConflictSignal|string')]
    public RecordConflictSignal|string $signal;

    /**
     * The kind of value that clashes: person_name or born.
     *
     * @var string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    public string $kind;

    /**
     * The two identifiers you gave whose records disagree.
     *
     * @var array<\NoResponse\Models\Shared\Between|string> $between
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('between')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Between|string>')]
    public array $between;

    /**
     * The ids of the two records that clash, in the order of between.
     *
     * @var array<string> $records
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('records')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>')]
    public array $records;

    /**
     * @param  \NoResponse\Models\Shared\RecordConflictSignal|string  $signal
     * @param  string  $kind
     * @param  array<\NoResponse\Models\Shared\Between|string>  $between
     * @param  array<string>  $records
     * @phpstan-pure
     */
    public function __construct(RecordConflictSignal|string $signal, string $kind, array $between, array $records)
    {
        $this->signal = $signal;
        $this->kind = $kind;
        $this->between = $between;
        $this->records = $records;
    }
}