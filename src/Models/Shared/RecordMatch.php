<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RecordMatch - One searched value that found the record. */
class RecordMatch
{
    /**
     * The kind of searched value: email, phone, username, ip, name, password, hash, domain, or handle for a profile read of a handle.
     *
     * @var string $by
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('by')]
    public string $by;

    /**
     * The field the searched value hit, when the record holds it.
     *
     * @var ?string $field
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('field')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $field = null;

    /**
     * The search a person started on a value of another record that found this one, among the person report's searches, which names the value and the record and field it came from. A record found only by such searches is a lead, whatever kind of value found it. Absent for a match of the lookups.
     *
     * @var ?string $search
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('search')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $search = null;

    /**
     * @param  string  $by
     * @param  ?string  $field
     * @param  ?string  $search
     * @phpstan-pure
     */
    public function __construct(string $by, ?string $field = null, ?string $search = null)
    {
        $this->by = $by;
        $this->field = $field;
        $this->search = $search;
    }
}