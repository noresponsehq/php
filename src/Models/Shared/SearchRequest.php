<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** SearchRequest - The value to search again, named by the record and field that hold it rather than sent again. */
class SearchRequest
{
    /**
     * One of the person's records: a lookup's, a profile's or one an earlier search found.
     *
     * @var string $recordId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('record_id')]
    public string $recordId;

    /**
     * The name of the record's field whose value to search. Its kind must be email, phone, username, person_name, password, hash or ip.
     *
     * @var string $field
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('field')]
    public string $field;

    /**
     * Search only this breach table, as a remaining entry names it, to fetch the rows an earlier search left out. Not for a phone.
     *
     * @var ?string $table
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('table')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $table = null;

    /**
     * @param  string  $recordId
     * @param  string  $field
     * @param  ?string  $table
     * @phpstan-pure
     */
    public function __construct(string $recordId, string $field, ?string $table = null)
    {
        $this->recordId = $recordId;
        $this->field = $field;
        $this->table = $table;
    }
}