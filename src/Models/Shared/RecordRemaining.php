<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RecordRemaining - Rows one search matched in one source that the lookup's records leave out, so no answer is cut short in silence. */
class RecordRemaining
{
    /**
     * Where a record came from.
     *
     * @var \NoResponse\Models\Shared\RecordSource $source
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('source')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RecordSource')]
    public RecordSource $source;

    /**
     * The kind of searched value whose search matched the rows, as a record's matched names it.
     *
     * @var string $by
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('by')]
    public string $by;

    /**
     * How many rows of the source that search matched beyond the records the lookup carries.
     *
     * @var int $rows
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('rows')]
    public int $rows;

    /**
     * The search a person started that matched the rows. Searching the same field again with this source's table fetches them.
     *
     * @var ?string $search
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('search')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $search = null;

    /**
     * @param  \NoResponse\Models\Shared\RecordSource  $source
     * @param  string  $by
     * @param  int  $rows
     * @param  ?string  $search
     * @phpstan-pure
     */
    public function __construct(RecordSource $source, string $by, int $rows, ?string $search = null)
    {
        $this->source = $source;
        $this->by = $by;
        $this->rows = $rows;
        $this->search = $search;
    }
}