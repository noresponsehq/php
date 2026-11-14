<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RecordField - One value a source returned. */
class RecordField
{
    /**
     * The source's own name for the field. A nested value's name is dotted, and a list element's carries its index.
     *
     * @var string $field
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('field')]
    public string $field;

    /**
     * The value as the source wrote it. A count is written in decimal and a time in RFC 3339.
     *
     * @var string $original
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('original')]
    public string $original;

    /**
     * What sort of value the field holds. Absent until the field's kind is known.
     *
     * @var ?string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $kind = null;

    /**
     * Which common field it is, where many sources share it, such as handle, display_name, account_id, profile_link, picture, bio, website, linked_account (named by its network), account_status, joined, last_updated, organisation, location, followers, following or posts. Absent for a field only this source returns.
     *
     * @var ?string $role
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('role')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $role = null;

    /**
     * The cleaned value. Absent when it cannot be cleaned, or until the field's kind is known.
     *
     * @var ?string $value
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('value')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $value = null;

    /**
     * @param  string  $field
     * @param  string  $original
     * @param  ?string  $kind
     * @param  ?string  $role
     * @param  ?string  $value
     * @phpstan-pure
     */
    public function __construct(string $field, string $original, ?string $kind = null, ?string $role = null, ?string $value = null)
    {
        $this->field = $field;
        $this->original = $original;
        $this->kind = $kind;
        $this->role = $role;
        $this->value = $value;
    }
}