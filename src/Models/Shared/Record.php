<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Record - One answer from one source: where it came from, what found it and every field it holds. A person's lookup records also say how likely each is the person. */
class Record
{
    /**
     * Made from the source and the fields' names and original values, so the same answer found twice is one record with the same id. Its fields are typed as its latest finding typed them.
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
     * How likely the record is the person it was found for, from 0.01 to 0.99, to two places. A record found by the person's own email or phone starts as theirs; any other starts lower the more people its search found on its site. Each value it shares with what is known of the person raises it, a rare value more than a common one, and a different birth date or full name lowers it. What is known is what the person's row gives and the values of their own records: those found by their email or phone, and those a reviewer joined. A record whose source kind starts with domain_ describes an email's domain, not the person, so it is not compared and adds nothing to what is known: it stays at 0.99 when the person's own email found it and at 0.5 otherwise. Present on a person's lookup records, with agreed, clashed and joined.
     *
     * @var ?float $likelihood
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('likelihood')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?float $likelihood = null;

    /**
     * The fields of this record whose values agreed with what is known of the person, by their field names, in the record's order. The value that found the record is not among them.
     *
     * @var ?array<string> $agreed
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('agreed')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $agreed = null;

    /**
     * The fields of this record that clashed with what is known of the person: a birth date or a full name that differs from the person's.
     *
     * @var ?array<string> $clashed
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('clashed')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $clashed = null;

    /**
     * Whether the record joins the person: its likelihood reached 0.9 or a reviewer joined it, and no reviewer rejected it. A record that does not join stays a lead.
     *
     * @var ?bool $joined
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('joined')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $joined = null;

    /**
     * A reviewer's overrule (POST .../people/{person_id}/records), which decides joined whatever the likelihood and sticks for as long as a lookup finds the same record. Absent when nobody overruled it.
     *
     * @var \NoResponse\Models\Shared\Verdict|string|null $verdict
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('verdict')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Verdict|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Verdict|string|null $verdict = null;

    /**
     * @param  string  $id
     * @param  \NoResponse\Models\Shared\RecordSource  $source
     * @param  array<\NoResponse\Models\Shared\RecordMatch>  $matched
     * @param  array<\NoResponse\Models\Shared\RecordField>  $fields
     * @param  string  $observedAt
     * @param  ?float  $likelihood
     * @param  ?array<string>  $agreed
     * @param  ?array<string>  $clashed
     * @param  ?bool  $joined
     * @param  \NoResponse\Models\Shared\Verdict|string|null  $verdict
     * @phpstan-pure
     */
    public function __construct(string $id, RecordSource $source, array $matched, array $fields, string $observedAt, ?float $likelihood = null, ?array $agreed = null, ?array $clashed = null, ?bool $joined = null, Verdict|string|null $verdict = null)
    {
        $this->id = $id;
        $this->source = $source;
        $this->matched = $matched;
        $this->fields = $fields;
        $this->observedAt = $observedAt;
        $this->likelihood = $likelihood;
        $this->agreed = $agreed;
        $this->clashed = $clashed;
        $this->joined = $joined;
        $this->verdict = $verdict;
    }
}