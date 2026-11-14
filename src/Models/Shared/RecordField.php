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
     * The value as the source wrote it. A count is written in decimal and a time in RFC 3339; a breach column's value is as the leak holds it.
     *
     * @var string $original
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('original')]
    public string $original;

    /**
     * What sort of value a field holds, which decides how it is cleaned, compared and searched again. It comes from the value itself where its shape is certain (an email, an IP, a URL, an international phone number), else from the answer stored for the source's column, else text. A value of any kind is returned.
     *
     * @var \NoResponse\Models\Shared\RecordKind|string|null $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RecordKind|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public RecordKind|string|null $kind = null;

    /**
     * Which common field a value is, where many sources share it: a join date and a birth date are both dates, with the roles joined and born. A platform account's field and a breach row's column with the same meaning carry the same kind and role. A linked_account field is named by its network. Absent for a field only its source returns.
     *
     * @var \NoResponse\Models\Shared\RecordRole|string|null $role
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('role')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RecordRole|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public RecordRole|string|null $role = null;

    /**
     * The value cleaned to its kind's one form: an email in lower case, a phone number in international form when its country is known, a date in ISO form, a country as its two-letter code, a flag as true or false. Absent when the value cannot be cleaned as its kind; original still holds it.
     *
     * @var ?string $value
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('value')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $value = null;

    /**
     * What the value shows of itself beyond its kind: the likely algorithm of a hash, the likely coin of a crypto address or the currency of an amount.
     *
     * @var ?string $detail
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('detail')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $detail = null;

    /**
     * @param  string  $field
     * @param  string  $original
     * @param  \NoResponse\Models\Shared\RecordKind|string|null  $kind
     * @param  \NoResponse\Models\Shared\RecordRole|string|null  $role
     * @param  ?string  $value
     * @param  ?string  $detail
     * @phpstan-pure
     */
    public function __construct(string $field, string $original, RecordKind|string|null $kind = null, RecordRole|string|null $role = null, ?string $value = null, ?string $detail = null)
    {
        $this->field = $field;
        $this->original = $original;
        $this->kind = $kind;
        $this->role = $role;
        $this->value = $value;
        $this->detail = $detail;
    }
}