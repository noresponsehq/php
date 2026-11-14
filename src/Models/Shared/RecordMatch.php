<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RecordMatch - One searched value that found the record. */
class RecordMatch
{
    /**
     * The kind of searched value: email, phone, username, ip, name, or handle for a profile read of a handle.
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
     * @param  string  $by
     * @param  ?string  $field
     * @phpstan-pure
     */
    public function __construct(string $by, ?string $field = null)
    {
        $this->by = $by;
        $this->field = $field;
    }
}